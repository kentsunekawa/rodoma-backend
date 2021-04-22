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
                'name' => '設定なし'
            ],
            [
                'name' => 'IT・プログラミング'
            ],
            [
                'name' => 'デザイン・アート'
            ],
            [
                'name' => '金融'
            ],
            [
                'name' => '語学'
            ],
            [
                'name' => 'ビジネススキル'
            ],
            [
                'name' => '企画・マーケティング'
            ],
            [
                'name' => '健康・スポーツ'
            ],
            [
                'name' => '趣味・その他'
            ],
        ];
        foreach ($categories as $category) {
            DB::table('categories')->insert($category);
        }

    }
}
