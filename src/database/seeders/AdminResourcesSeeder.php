<?php

namespace Joymap\database\seeders;

use App\Models\AdminResource;
use Illuminate\Database\Seeder;

class AdminResourcesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $r1Sort = 0;
        $r2Sort = 0;
        $ar = [
            'permission' => [
                'role',
                'user'
            ],
            'store' => [
                'category',
                'list',
                'tag'
            ],
            'member' => [
                'list'
            ],
            'job' => [
                'list'
            ],
            'activity' => [
                'list'
            ],
            'report' => [
                'order',
                'comment',
                'defray',
                'jcoin',
                'company'
            ],
            'content' => [
                'notification',
                'qa',
                'customer'
            ]
        ];

        $icon = [
            'permission' => 'fas fa-lock',
            'permission.role' => 'fas fa-user',
            'permission.user' => 'fas fa-users',
            'store' => 'fas fa-store',
            'store.category' => 'fas fa-hat-wizard',
            'store.list' => 'fas fa-store',
            'store.tag' => 'fas fa-tag',
            'member' => 'fas fa-users',
            'member.list' => 'fas fa-user',
            'job' => 'fas fa-tasks',
            'job.list' => 'fas fa-tasks',
            'activity' => 'fas fa-list',
            'activity.list' => 'fas fa-list',
            'report' => 'fas fa-chart-line',
            'report.order' => 'fas fa-book-open',
            'report.comment' => 'fas fa-comments',
            'report.defray' => 'fas fa-dollar-sign',
            'report.jcoin' => 'fas fa-coins',
            'report.company' => 'far fa-building',
            'content' => 'fas fa-cogs',
            'content.notification' => 'fas fa-bell',
            'content.qa' => 'fas fa-question',
            'content.customer' => 'fas fa-table'
        ];

        foreach ($ar as $r1 => $a) {
            $adminResource = AdminResource::create(['name' => $r1, 'sort' => $r1Sort, 'icon' => $icon[$r1] ?? '']);
            $r1Sort++;

            foreach ($a as $r2) {
                AdminResource::create(['name' => $r2, 'sort' => $r2Sort, 'parent_id' => $adminResource->id, 'icon' => $icon["$r1.$r2"] ?? '']);
                $r2Sort++;
            }
            $r2Sort = 0;
        }
    }
}
