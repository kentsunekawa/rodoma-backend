<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialtyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specialties = [
            [
                'category_id' =>  1,
                'name' => 'specialty1'
            ],
            [
                'category_id' =>  2,
                'name' => 'specialty2'
            ],
            [
                'category_id' =>  2,
                'name' => 'specialty3'
            ],
            [
                'category_id' =>  2,
                'name' => 'specialty4'
            ],
            [
                'category_id' =>  2,
                'name' => 'specialty5'
            ],
            [
                'category_id' =>  2,
                'name' => 'specialty6'
            ],
            [
                'category_id' =>  3,
                'name' => 'specialty7'
            ],
            [
                'category_id' =>  3,
                'name' => 'specialty8'
            ],
            [
                'category_id' =>  3,
                'name' => 'specialty9'
            ],
            [
                'category_id' =>  3,
                'name' => 'specialty10'
            ],
            [
                'category_id' =>  3,
                'name' => 'specialty11'
            ],
            [
                'category_id' =>  4,
                'name' => 'specialty12'
            ],
            [
                'category_id' =>  4,
                'name' => 'specialty13'
            ],
            [
                'category_id' =>  4,
                'name' => 'specialty14'
            ],
            [
                'category_id' =>  4,
                'name' => 'specialty15'
            ],
            [
                'category_id' =>  4,
                'name' => 'specialty16'
            ],
            [
                'category_id' =>  5,
                'name' => 'specialty17'
            ],
            [
                'category_id' =>  5,
                'name' => 'specialty18'
            ],
            [
                'category_id' =>  5,
                'name' => 'specialty19'
            ],
            [
                'category_id' =>  5,
                'name' => 'specialty20'
            ],
            [
                'category_id' =>  5,
                'name' => 'specialty21'
            ],
            [
                'category_id' =>  6,
                'name' => 'specialty22'
            ],
            [
                'category_id' =>  6,
                'name' => 'specialty23'
            ],
            [
                'category_id' =>  6,
                'name' => 'specialty24'
            ],
            [
                'category_id' =>  6,
                'name' => 'specialty25'
            ],
            [
                'category_id' =>  6,
                'name' => 'specialty26'
            ],
        ];
        foreach($specialties as $specialty) {
            DB::table('specialties')->insert($specialty);
        }
    }
}
