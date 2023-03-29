<?php

namespace Joymap\database\seeders;

use Illuminate\Database\Seeder;

class StorePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = \file_get_contents(__DIR__ . '/../../storage/store_permission.json', true);
        $ctx = json_decode($file, true);

        $pSort = 1;
        foreach ($ctx as $key => $children) {
            $parentPermission = \App\Models\StorePermission::create([
                'name' => $key,
                'parent_id' => 0,
                'sort' => $pSort
            ]);

            foreach ($children as $k => $value) {
                \App\Models\StorePermission::create([
                    'name' => $value,
                    'parent_id' => $parentPermission->id,
                    'sort' => $k + 1
                ]);
            }

            $pSort++;
        }
    }
}
