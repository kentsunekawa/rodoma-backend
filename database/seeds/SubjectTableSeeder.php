<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects = [
            [
                'post_id' => 1,
                'label' => 0,
                'linked_post_id' => null,
                'renge_start' => 0,
                'renge_end' => 50,
                'title' => 'HTML',
                'description' => 'HTML を勉強しましょう。',
                'created_at' => new DateTime('now'),
                'updated_at' => new DateTime('now'),
            ],


        ];
        foreach($subjects as $subject) {
            DB::table('subjects')->insert($subject);
        }
    }
}
