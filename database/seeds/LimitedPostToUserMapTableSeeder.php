<?php

use Illuminate\Database\Seeder;
use App\Models\LimitedPostToUserMap;

class LimitedPostToUserMapTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataList = [
            // [
            //     'user_id' => 71,
            //     'post_id' => 20,
            // ],
            // [
            //     'user_id' => 1,
            //     'post_id' => 17,
            // ],
            // [
            //     'user_id' => 2,
            //     'post_id' => 17,
            // ],
            // [
            //     'user_id' => 2,
            //     'post_id' => 18,
            // ],
            // [
            //     'user_id' => 3,
            //     'post_id' => 18,
            // ],
            // [
            //     'user_id' => 3,
            //     'post_id' => 19,
            // ],
        ];

        foreach($dataList as $data) {
            LimitedPostToUserMap::create($data );
        }
    }
}
