<?php

namespace Joymap\database\seeders;

use Joymap\Models\AdminPermission;
use Joymap\Models\AdminRole;
use Joymap\Models\AdminUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = AdminRole::create([
            'name' => 'super-admin',
            'is_active' => 1
        ]);

        $permissions = AdminPermission::all();

        foreach ($permissions as $permission) {
            // $role->givePermissionTo($permission);
            $role->permissions()->attach($permission->id);
        }

        $adminUser = [
            [
                'name' => 'jason',
                'email' => 'jason@twdd.com.tw',
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'denny',
                'email' => 'denny@twdd.com.tw',
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'karen',
                'email' => 'karen@twdd.com.tw',
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'oscar',
                'email' => 'oscar@twdd.com.tw',
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'willy',
                'email' => 'willy@twdd.com.tw',
                'password' => Hash::make('123456')
            ]
        ];

        foreach ($adminUser as $admin) {
            $user = AdminUser::create($admin);
            // $user->assignRole('super-admin');
            DB::table('model_has_admin_roles')->insert([
                'role_id' => $role->id,
                'model_type' => 'App\Models\AdminUser',
                'model_id' => $user->id
            ]);
        }
    }
}
