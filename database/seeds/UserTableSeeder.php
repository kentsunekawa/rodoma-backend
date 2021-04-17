<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 1; $i++) {
            factory(User::class)->create();
        }

        // $users = [
        //     [
        //         'name' => 'Ken Tsunekawa',
        //         'email' => 'info@k-tsunekawa.com',
        //         'email_verified_at' => new DateTime('now'),
        //         'password' => Hash::make('password'),
        //         'icon_url' => '/user_icon/user1.jpg',
        //         'remember_token' => null,
        //         'created_at' => new DateTime('now'),
        //         'updated_at' => new DateTime('now'),
        //     ],
        //     [
        //         'name' => 'aaaa aaaa',
        //         'email' => 'aaaa@aaaa.com',
        //         'email_verified_at' => new DateTime('now'),
        //         'password' => Hash::make('password'),
        //         'icon_url' => null,
        //         'remember_token' => null,
        //         'created_at' => new DateTime('now'),
        //         'updated_at' => new DateTime('now'),
        //     ],
        //     [
        //         'name' => 'bbbb bbbb',
        //         'email' => 'bbbb@bbbb.com',
        //         'email_verified_at' => new DateTime('now'),
        //         'password' => Hash::make('password'),
        //         'icon_url' => null,
        //         'remember_token' => null,
        //         'created_at' => new DateTime('now'),
        //         'updated_at' => new DateTime('now'),
        //     ],
        //     [
        //         'name' => 'cccc cccc',
        //         'email' => 'cccc@cccc.com',
        //         'email_verified_at' => new DateTime('now'),
        //         'password' => Hash::make('password'),
        //         'icon_url' => null,
        //         'remember_token' => null,
        //         'created_at' => new DateTime('now'),
        //         'updated_at' => new DateTime('now'),
        //     ],
        //     [
        //         'name' => 'dddd dddd',
        //         'email' => 'dddd@dddd.com',
        //         'email_verified_at' => new DateTime('now'),
        //         'password' => Hash::make('password'),
        //         'icon_url' => null,
        //         'remember_token' => null,
        //         'created_at' => new DateTime('now'),
        //         'updated_at' => new DateTime('now'),
        //     ],
        // ];

        // foreach($users as $user) {
        //     User::create($user);
        // }
    }
}
