<?php

namespace Joymap\Services\Admin;

use App\Models\AdminResource;
use App\Models\AdminRole;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class AdminResourceService
{
    public $topLayer;

    public $permissions;

    public function __construct()
    {
        $this->topLayer = 0;

        $this->permissions = [
            'c' => 'create',
            'r' => 'read',
            'u' => 'update',
            'd' => 'delete'
        ];
    }

    /**
     * 取得頂層資料
     *
     * @return Collection
     */
    public function getTopLayer(): Collection
    {
        return AdminResource::where('parent_id', $this->topLayer)->orderBy('sort')->get();
    }

    /**
     * 取得所有資料(包含孩子們)
     *
     * @return Collection
     */
    public function getLayerRecursive(): Collection
    {
        return AdminResource::with('childrenRecursive')->where('parent_id', $this->topLayer)->orderBy('id')->get();
    }

    public function getResourceNameArray(): array
    {
        $res = [];
        $tree = $this->resourceTree();

        foreach ($tree as $key => $value) {
        }
        return $res;
    }

    /**
     * 由最頂層Resource網下取得個階層資料與名稱
     *
     * @return array
     */
    public function resourceTree($auth = false): array
    {
        $topLayer = $this->getTopLayer();

        return $this->recursiveChildren($topLayer, [], $auth);
    }

    /**
     * 遞迴取得AdminResource Children 與 Info資料
     *
     * @param  mixed $adminResources
     * @param  mixed $out
     * @return array
     */
    public function recursiveChildren(Collection $adminResources, $out = [], $auth = false): array
    {
        $userPermissions = null;
        if ($auth) {
            $userPermissions = Auth::user()->permissionNameList;
        }

        foreach ($adminResources as $adminResource) {

            $permissionName = $this->combineParentName($adminResource);
            $permissionName = $permissionName == '' ? $adminResource->name : $permissionName . "." . $adminResource->name;

            // 如果要檢查沒有read權限就不出現
            if (isset($userPermissions) && !in_array("$permissionName.read", $userPermissions)) {
                continue;
            }

            $out[$adminResource->name] = [
                'info' => [
                    'id' => $adminResource->id,
                    'custom_path' => $adminResource->custom_path,
                    'sort' => $adminResource->sort,
                    'icon' => $adminResource->icon,
                    'parent_id' => $adminResource->parent_id,
                    'permission_name' => $permissionName,
                ],
                'children' => []
            ];
            // 如果此階層有小孩,就遞迴繼續抓小孩
            if ($adminResource->childrenRecursive()->count() > 0) {
                $out[$adminResource->name]['children'] = $this->recursiveChildren($adminResource->childrenRecursive()->orderBy('sort')->get(), [], $auth);
                foreach ($out[$adminResource->name]['children'] as $k => $v) {
                    if ($out[$adminResource->name]['is_open'] = Str::is($v['info']['permission_name'].".*", Route::currentRouteName())){
                        $out[$adminResource->name]['children'][$k]['other_css'] = 'text-yellow-500';
                        break;
                    }
                }
            }
        }

        return $out;
    }

    /**
     * 建立Resource與Permission
     *
     * @param  mixed $input
     * @return void
     */
    public function createWithPermission(array $input)
    {
        $adminResource = AdminResource::create($input);

        $parentNameString = $this->combineParentName($adminResource);

        if (!empty($parentNameString)) {
            $parentNameString = $parentNameString . '.' . $input['name'];
        } else {
            $parentNameString = $input['name'];
        }

        foreach ($this->permissions as $k => $permission) {
            $name = $parentNameString . '.' . $permission;
            $adminResource->permissions()->create([
                'name' => $name,
            ]);
        }

        return $adminResource;
    }

    /**
     * 找出父層並組合出名稱
     *
     * @param  mixed $resource
     * @param  mixed $names
     * @return string
     */
    public function combineParentName($resource, $names = [])
    {
        $parent = $resource->parent()->first();

        if (isset($parent)) {
            array_unshift($names, $parent->name);

            return $this->combineParentName($parent, $names);
        } else {
            return implode('.', $names);
        }
    }

    public function createPermissionName($resource, string $name)
    {
        $result = [];

        $parentNameString = $this->combineParentName($resource);

        if (!empty($parentNameString)) {
            $parentNameString = $parentNameString . '.' . $name;
        } else {
            $parentNameString = $name;
        }

        foreach ($this->permissions as $k => $permission) {
            $name = $parentNameString . '.' . $permission;
            $result[$k] = $name;
        }

        return $result;
    }

    /**
     * 更新resource
     *
     * @param  mixed $id
     * @param  mixed $attr
     * @return void
     */
    public function update(int $id, array $attr)
    {
        return AdminResource::find($id)->update($attr);
    }

    /**
     * 更新resource與對應的permission
     *
     * @param  mixed $input
     * @return void
     */
    public function updateWithPermission(array $input)
    {
        $id = $input['id'];
        unset($input['id']);

        $resource = AdminResource::find($id);

        $resourcePermissions = $resource->permissions()->get();

        // 名稱跟parent都改 ，更新permissions的name
        $this->update($id, $input);
        $resource = AdminResource::find($id);
        $permissionNames = $this->createPermissionName($resource, $input['name']);

        foreach ($resourcePermissions as $permission) {
            $lastPermissionName = last(explode('.', $permission->name));
            switch ($lastPermissionName) {
                case 'create':
                    $newPermissionName = $permissionNames['c'];
                    break;
                case 'read':
                    $newPermissionName = $permissionNames['r'];
                    break;
                case 'update':
                    $newPermissionName = $permissionNames['u'];
                    break;
                case 'delete':
                    $newPermissionName = $permissionNames['d'];
                    break;
            }
            $permission->update([
                'name' => $newPermissionName
            ]);
        }

        return true;
    }

    public function delete(int $id)
    {
        $resource = AdminResource::find($id);

        if ($resource->children()->count() != 0) {

            return '請先刪除孩子們';
        }

        $permissions = $resource->permissions()->get();
        foreach ($permissions as $permission) {
            $permission->roles()->detach();
            $permission->delete();
        }

        $resource->delete();

        return true;
    }
}
