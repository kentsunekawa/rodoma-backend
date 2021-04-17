<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'category1'
            ],
            [
                'name' => 'category2'
            ],
            [
                'name' => 'category3'
            ],
            [
                'name' => 'category4'
            ],
            [
                'name' => 'category5'
            ],
            [
                'name' => 'category6'
            ],
        ];
        foreach ($categories as $category) {
            DB::table('categories')->insert($category);
        }

    }
}
