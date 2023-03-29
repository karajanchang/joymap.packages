<?php

namespace Joymap\database\seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;
use Faker;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $avatar = [
            null,
            'https://memeprod.ap-south-1.linodeobjects.com/user-template/991965732ea91b89567976a2920c86e7.png',
            'https://cache.ptt.cc/c/https/i.imgur.com/PI6RejHl.jpg?e=1631925364&s=tOFPQgx6ULWasYhqANwNkg',
            'https://cache.ptt.cc/c/https/i.imgur.com/4xscMddl.jpg?e=1631929881&s=ATE14e1JKR2SSwnKLCEUfQ',
            'https://cache.ptt.cc/c/https/i.imgur.com/UU348ael.jpg?e=1631935509&s=KXAZcubtGYA7CtHN2Z18pQ',
            'https://cache.ptt.cc/c/https/i.imgur.com/AFpyjLvl.jpg?e=1631913640&s=beI5jUNM0dLlnUmVI0q5GA',
            'https://cache.ptt.cc/c/https/i.imgur.com/HPmMR9nl.jpg?e=1631922603&s=c6OOQiAyvbNpgaHIQhJH9w',
            'https://images.chinatimes.com/newsphoto/2020-11-22/1024/20201122004136.jpg'
        ];
        for ($x = 1; $x < 100; $x++) {
            $from_invite_id = rand(0,99);
            if($from_invite_id == $x || $from_invite_id == 0 || $from_invite_id == 99){
                $from_invite_id = null;
            }

            $faker = Faker\Factory::create();
            Member::create([
                "name" => "M_$x",
                "nick_name" => "M_N_$x",
                "phone_prefix" => '886',
                "phone" => "09" . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9),
                "email" => "member_$x@gmail.com",
                "gender" => rand(0, 1),
                "member_no" => "JM-$x",
                "avatar" => $avatar[rand(0,7)], 
                "is_active" => rand(0, 1),
                "is_email_active" => rand(0, 1),
                "status" => rand(0, 1),
                "birthday" => $faker->date('Y-m-d'),
                "tax_number" =>  $faker->randomNumber(8, true),
                "level_id" => rand(1, 5),
                "from_source" => rand(0, 3),
                "register_device" => $faker->randomElement(['iPhone', 'Android', 'PC']),
                "invite_code" => strtoupper($faker->lexify('??????')),
                "from_invite_id" => $from_invite_id,
                "created_at" => $faker->date('Y-m-d H:i:s'),
                "updated_at" => $faker->date('Y-m-d H:i:s'),
            ]);
        }
    }
}
