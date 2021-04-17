<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Profile;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for($i = 0; $i < 100; $i++) {
            factory(Profile::class)->create();
        }

        // $profiles = [
        //     [
        //         'user_id' => 1,
        //         'category_id' => 2,
        //         'specialty_id' => 2,
        //         'catch_copy' => 'BEYOND Must Be Beautiful',
        //         'description' => 'Hi, I am Ken Tsunekawa.',
        //         'created_at' => new DateTime('now'),
        //         'updated_at' => new DateTime('now'),
        //     ],
        //     [
        //         'user_id' => 2,
        //         'category_id' => 3,
        //         'specialty_id' => 9,
        //         'catch_copy' => 'For Beautiful Human Life.',
        //         'description' => 'Hi, I am aaa aaaaaaa.',
        //         'created_at' => new DateTime('now'),
        //         'updated_at' => new DateTime('now'),
        //     ],
        //     [
        //         'user_id' => 3,
        //         'category_id' => 4,
        //         'specialty_id' => 15,
        //         'catch_copy' => 'Inspire the Next.',
        //         'description' => 'Hi, I am bbb bbbbbbb.',
        //         'created_at' => new DateTime('now'),
        //         'updated_at' => new DateTime('now'),
        //     ],
        //     [
        //         'user_id' => 4,
        //         'category_id' => 5,
        //         'specialty_id' => 17,
        //         'catch_copy' => 'JUST DO IT.',
        //         'description' => 'Hi, I am ccc ccccccc.',
        //         'created_at' => new DateTime('now'),
        //         'updated_at' => new DateTime('now'),
        //     ],
        //     [
        //         'user_id' => 5,
        //         'category_id' => 6,
        //         'specialty_id' => 24,
        //         'catch_copy' => 'For Beautiful Human Life.',
        //         'description' => 'Hi, I am aaa aaaaaaa.',
        //         'created_at' => new DateTime('now'),
        //         'updated_at' => new DateTime('now'),
        //     ],
        // ];
        // foreach($profiles as $profile) {
        //     DB::table('profiles')->insert($profile);
        // }
    }
}
