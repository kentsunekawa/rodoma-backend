<?php

use Illuminate\Database\Seeder;
use App\Models\Like;

class LikeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $likes = [
            [
                'user_id' => 10,
                'post_id' => 50
            ],
            [
                'user_id' => 10,
                'post_id' => 49
            ],
            [
                'user_id' => 10,
                'post_id' => 48
            ],
            [
                'user_id' => 10,
                'post_id' => 47
            ],
            [
                'user_id' => 10,
                'post_id' => 46
            ],
            [
                'user_id' => 10,
                'post_id' => 45
            ],
            [
                'user_id' => 10,
                'post_id' => 44
            ],
            [
                'user_id' => 10,
                'post_id' => 43
            ],
            [
                'user_id' => 10,
                'post_id' => 42
            ],
            [
                'user_id' => 1,
                'post_id' => 30
            ],
            [
                'user_id' => 2,
                'post_id' => 30
            ],
            [
                'user_id' => 3,
                'post_id' => 30
            ],
            [
                'user_id' => 4,
                'post_id' => 30
            ],
            [
                'user_id' => 5,
                'post_id' => 30
            ],
            [
                'user_id' => 6,
                'post_id' => 30
            ],
            [
                'user_id' => 7,
                'post_id' => 30
            ],

        ];
        foreach($likes as $like) {
            Like::create($like);
        }
    }
}
