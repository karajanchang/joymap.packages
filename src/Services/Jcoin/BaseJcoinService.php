<?php

namespace Joymap\Services\Jcoin;

use GuzzleHttp\Client;
use Exception;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

abstract class BaseJcoinService
{
    /**
     * J幣API Domain URL
     *
     * @var mixed
     */
    protected $baseUrl;

    /**
     * J壁API USER
     *
     * @var mixed
     */
    protected $jUser;

    /**
     * J幣API PW
     *
     * @var mixed
     */
    protected $jPw;

    public function setBaseUrl($url)
    {
        $this->baseUrl = $url;

        return $this;
    }

    public function setJUser($user)
    {
        $this->jUser = $user;

        return $this;
    }

    public function setJpw($password)
    {
        $this->jPw = $password;

        return $this;
    }

    public function valid($datas, $rules, $messages = [], $customAttributes = [])
    {
        try {
           return Validator::make($datas, $rules, $messages, $customAttributes)->validate();
        } catch (ValidationException $e) {
            throw $e;
        }
    }

    protected function callApi(string $type, string $urlPath, array $data = [], $rules = [], $messages = [], $customAttributes = [])
    {
        $hasData = empty($data) ? false : true;

        $client = new Client([
            'base_uri' => $this->baseUrl,
            'headers' => [
                'user' => $this->jUser,
                'pw' => $this->jPw
            ]
        ]);

        try {
            if (!empty($rules)) {
                $data = $this->valid($data, $rules, $messages, $customAttributes);
            }

            if ($hasData) {
                $res = $client->request($type, $urlPath, [
                    'json' => $data
                ]);
            } else {
                $res = $client->request($type, $urlPath);
            }
            $resBody = json_decode((string) $res->getBody()->getContents(), true);

            if ($resBody['code'] == 1) {
                return $resBody['return'];
            }

            throw new Exception;
        } catch (ClientException $e) {
            $this->logs($urlPath, $data, Psr7\Message::toString($e->getResponse()));
            return false;
        } catch (ValidationException $e) {
            $this->validLogs("JCOIN Valid Fail", $urlPath, $data, $e);
            return false;
        } catch (\Throwable $th) {
            $this->logs($urlPath, $data, $th->getMessage());
            return false;
        }
    }

    protected function logs(string $url, array $requestData = [], string $msg = null)
    {
        Log::error('JCOIN-API-FAIL', [
            '呼叫API' => $url,
            'Request Data' => $requestData,
            '失敗原因' => $msg
        ]);
    }

    protected function validLogs(string $title, string $urlPath, array $input = [], $exception = null)
    {
        Log::error($title, [
            'URL Path' => $urlPath,
            'Input Data' => $input,
            '失敗原因' => $exception->validator->errors()->all()
        ]);
    }

    /**
     * 儲值J幣
     *
     * @param  mixed $data
     * @return void
     */
    public function add(array $data)
    {
        $rules = [
            'title' => 'required|string',
            'user_id' => 'required|string',
            'token' => 'required|string',
            'coins' => 'required|integer',
            'start_at' => 'sometimes|nullable|date|before:expired_at',
            'expired_at' => 'required|date|date_format:Y-m-d|after:now',
            'order_id' => 'sometimes|nullable|string',
            'comment' => 'sometimes|nullable|string',
        ];

        return $this->callApi('POST', '/coin-deposit', $data, $rules);
    }

    /**
     * 儲值分潤
     *
     * @param  mixed $data
     * @return void
     */
    public function addBonus(array $data)
    {
        $rule = [
            'title' => 'required|string',
            'user_id' => 'required|string',
            'token' => 'required|string',
            'coins' => 'required|integer',
            'start_at' => 'sometimes|nullable|date|before:expired_at',
            'expired_at' => 'required|date|date_format:Y-m-d|after:now',
            'order_id' => 'sometimes|nullable|string',
            'comment' => 'sometimes|nullable|string',
        ];

        return $this->callApi('POST', '/coin-deposit-profit-share', $data, $rule);
    }

    /**
     * 建立J幣帳戶
     *
     * @param  string $phone
     * @param  string $name
     * @return void
     */
    public function createUser(string $phone, string $name)
    {
        $data = [
            'mobile' => $phone,
            'nickname' => $name
        ];

        $rule = [
            'mobile' => 'required|string',
            'nickname' => 'required|string',
        ];

        return $this->callApi('POST', '/user/create', $data, $rule);
    }


    /**
     * 取得用戶J幣帳戶資料
     *
     * @param  string $phone 電話號碼
     * @param  string $nickName 暱稱(貌似只有新建時才有用 但必填)
     * @return void
     */
    public function getUserInfo(string $phone)
    {
        $data = [
            'mobile' => $phone,
        ];

        $rule = [
            'mobile' => 'required|string',
        ];

        return $this->callApi('POST', '/user/userid', $data, $rule);
    }

    /**
     * 取得J幣使用紀錄
     *
     * @param  mixed $data
     * @return void
     */
    public function coinLogs(array $data)
    {
        $rule = [
            'user_id' => 'required|string',
            'token' => 'required|string',
            'page' => 'sometimes|nullable|integer',
            'per_page_nums' => 'sometimes|nullable|integer',
        ];

        return $this->callApi('POST', '/logs', $data, $rule);
    }


    /**
     * 消耗J幣
     *
     * @param  mixed $data
     * @return void
     */
    public function sub(array $data)
    {
        $rule = [
            'title' => 'required|string',
            'user_id' => 'required|string',
            'token' => 'required|string',
            'coins' => 'required|integer',
            'order_id' => 'sometimes|nullable|string',
            'comment' => 'sometimes|nullable|string',
        ];

        return $this->callApi('POST', '/coin-use', $data, $rule);
    }

    /**
     * 提領
     * @param array $data
     * @return void
     */
    public function subBonus(array $data)
    {
        $rule = [
            'user_id' => 'required|string',
            'token' => 'required|string',
            'coins' => 'required|integer',
            'order_id' => 'sometimes|nullable|string',
            'comment' => 'sometimes|nullable|string',
        ];

        return $this->callApi('POST', '/coin-withdrawn', $data, $rule);
    }

    /**
     * 即將過期的用戶和點數
     * @param array $data
     * @return void
     */
    public function expired(array $data)
    {
        $rule = [
            'start_ts' => 'required|numeric',
            'end_ts' => 'required|numeric|gte:start_ts',
        ];

        try {
            $data = $this->valid($data, $rule);
        } catch (ValidationException $e) {
            $this->validLogs("JCOIN Valid Fail",'expired', $data, $e);
            return false;
        }

        $url = '/expired/'.$data['start_ts'].','.$data['end_ts'];

        return $this->callApi('GET', $url, $data);
    }
}
