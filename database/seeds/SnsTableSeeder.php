<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SnsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Twitter'
            ],
            [
                'name' => 'Facebook'
            ],
            [
                'name' => 'Linkedin'
            ],
            [
                'name' => 'instagram'
            ],
            [
                'name' => 'Pinterest'
            ],
            [
                'name' => 'YouTube'
            ],
            [
                'name' => 'note'
            ],
            [
                'name' => 'mixi'
            ],
        ];
        foreach($data as $record) {
            DB::table('sns')->insert($record);
        }
    }
}
