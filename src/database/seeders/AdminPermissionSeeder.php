<?php

namespace Joymap\database\seeders;

use App\Models\AdminPermission;
use App\Models\AdminResource;
use Joymap\Services\Admin\AdminResourceService;
use Illuminate\Database\Seeder;

class AdminPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $resources = \App\Models\AdminResource::where('parent_id', 0)->orderBy('sort')->get();

        foreach ($resources as $r1) {

            $this->createCRUDPermission($r1->id, $r1->name);

            $r2s = \App\Models\AdminResource::where('parent_id', $r1->id)->orderBy('sort')->get();

            foreach ($r2s as $r2) {
                $name = "{$r1->name}.{$r2->name}";
                $this->createCRUDPermission($r2->id, $name);
            }
        }
    }

    protected function createCRUDPermission(int $resource_id, string $name)
    {
        $serv = app(AdminResourceService::class);

        foreach ($serv->permissions as $key => $crud) {
            $permissionName = $name . ".$crud";
            \App\Models\AdminPermission::create([
                'name' => $permissionName,
                'resource_id' => $resource_id
            ]);
        }
    }
}
