<?php

use Illuminate\Database\Seeder;
use App\Models\Mark;

class MarkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $marks = [
        //     [
        //         'user_id' => 101,
        //         'post_id' => 1
        //     ],



        // ];
        // foreach($marks as $mark) {
        //     Mark::create($mark);
        // }

        for($i = 0; $i < 40; $i++) {
            Mark::create([
                'user_id' => 101,
                'post_id' => $i + 1,
            ]);
        }
    }
}
