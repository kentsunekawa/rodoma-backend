<?php

use Illuminate\Database\Seeder;

class ProfileToSnsMapTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $maps = [
            // [
            //     'profile_id' => 76,
            //     'sns_id' => 1,
            //     'url' => 'https://twitter.com/tsuneken0512'
            // ],
            // [
            //     'profile_id' => 76,
            //     'sns_id' => 3,
            //     'url' => 'https://www.linkedin.com/in/kentsunekawa/'
            // ],
            // [
            //     'profile_id' => 76,
            //     'sns_id' => 4,
            //     'url' => 'https://www.instagram.com/kentsunekawa/'
            // ],
            // [
            //     'profile_id' => 80,
            //     'sns_id' => 4,
            //     'url' => 'https://www.instagram.com/kentsunekawa/'
            // ],
            // [
            //     'profile_id' => 80,
            //     'sns_id' => 4,
            //     'url' => 'https://www.instagram.com/kentsunekawa/'
            // ],
            // [
            //     'profile_id' => 80,
            //     'sns_id' => 4,
            //     'url' => 'https://www.instagram.com/kentsunekawa/'
            // ],
            [
                'profile_id' => 71,
                'sns_id' => 4,
                'url' => 'https://www.instagram.com/kentsunekawa/'
            ],
            [
                'profile_id' => 71,
                'sns_id' => 3,
                'url' => 'https://www.linkedin.com/in/kentsunekawa/'
            ],
        ];
        foreach($maps as $map) {
            DB::table('profile_to_sns_maps')->insert($map);
        }
    }
}
