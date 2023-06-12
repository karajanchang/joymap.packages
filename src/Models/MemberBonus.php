<?php

namespace Joymap\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MemberBonus extends Model
{
    use HasFactory;

    protected $table = 'member_bonus';

    protected $guarded  = [];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function paylog()
    {
        return $this->belongsTo(PayLog::class, 'pay_log_id', 'id');
    }

    /**
     * MemberMonthBonusPayAmount
     * 取得每一個有獲得分潤的會員該月實際刷卡金額和分潤金額
     * @param  string $year 年份
     * @param  string $month 月份
     * @return mixed
     */
    public static function MemberMonthBonusPayAmount(string $year, string $month, $memberId = null, $status = null)
    {
        $date = Carbon::createFromDate($year, $month);
        $year = $date->format('Y');
        $month = $date->format('n');
        $firstDayofMonth = $date->startOfMonth()->format('Y-m-d 00:00:00');
        $lastDayofMonth = $date->endOfMonth()->format('Y-m-d 23:59:59');

        if (!isset($status) || is_null($status)) {
            $status = 0;
        }
        $condition = "
                status = $status
            AND
                year = $year
            AND
                month = $month
        ";

        if (isset($memberId) && !is_null($memberId)) {
            $condition .= " AND member_id = $memberId ";
        }
        //先抓經銷身分
        $memberDealerBonus = self::selestBonusPayAmount($condition, 1, $firstDayofMonth, $lastDayofMonth);
        //再抓樂粉身分
        $condition .= " AND relation_level < 5 ";
        $memberBonus = self::selestBonusPayAmount($condition, 0, $firstDayofMonth, $lastDayofMonth);
        //合併
        $memberBonus = $memberBonus->concat($memberDealerBonus);

        return $memberBonus;
    }

    /**
     * 執行每一個有獲得分潤的會員該月實際刷卡金額和分潤金額
     * @param  string $condition 語法
     * @param  bool $dealerGrade 經銷商身分
     * @param  Carbon $firstDayofMonth 月份(月初)
     * @param  Carbon $lastDayofMonth 月份(月底)
     * @return mixed
     */
    protected static function selestBonusPayAmount($condition, $dealerGrade, $firstDayofMonth, $lastDayofMonth)
    {
        return self::hydrate(DB::select("
            SELECT
                mb.member_id as member_id,
                IFNULL(SUM(pl.user_pay_amount),
                0) AS user_pay_amount,
                mb.total_bonus as total_bonus
            FROM
                (
                    SELECT
                        member_id,
                        SUM(bonus_jcoin) as total_bonus
                    FROM
                        `member_bonus`
                    WHERE
                        $condition
                    GROUP BY
                        member_id
                ) AS mb
                LEFT JOIN(
                    SELECT
                        member_id,
                        user_pay_amount
                    FROM
                        pay_logs
                    WHERE
                        created_at BETWEEN '$firstDayofMonth' AND '$lastDayofMonth'
                    AND
                        user_pay_status = 1
                ) AS pl
                ON
                    mb.member_id = pl.member_id
                LEFT JOIN members AS m
                ON
                    mb.member_id = m.id
                WHERE m.is_joy_dealer = $dealerGrade
                GROUP BY
                    mb.member_id
                ORDER BY mb.member_id ASC
            "));
    }
}
