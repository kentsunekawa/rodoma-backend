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
                'name' => '設定なし'
            ],
            [
                'category_id' =>  2,
                'name' => 'プログラミング言語'
            ],
            [
                'category_id' =>  2,
                'name' => 'ネットワーク・セキュリティー'
            ],
            [
                'category_id' =>  2,
                'name' => 'データベース'
            ],
            [
                'category_id' =>  2,
                'name' => 'AI・人工知能'
            ],
            [
                'category_id' =>  2,
                'name' => 'OS'
            ],
            [
                'category_id' =>  2,
                'name' => 'ソフトウェア'
            ],
            [
                'category_id' =>  2,
                'name' => 'ハードウェア'
            ],
            [
                'category_id' =>  2,
                'name' => 'IT資格'
            ],
            [
                'category_id' =>  2,
                'name' => 'その他'
            ],
            [
                'category_id' =>  3,
                'name' => 'グラフィックデザイン'
            ],
            [
                'category_id' =>  3,
                'name' => 'WEBデザイン'
            ],
            [
                'category_id' =>  3,
                'name' => 'ゲームデザイン'
            ],
            [
                'category_id' =>  3,
                'name' => 'イラストレーション'
            ],
            [
                'category_id' =>  3,
                'name' => '建築'
            ],
            [
                'category_id' =>  3,
                'name' => 'ファッション'
            ],
            [
                'category_id' =>  3,
                'name' => 'インテリア'
            ],
            [
                'category_id' =>  3,
                'name' => '写真'
            ],
            [
                'category_id' =>  3,
                'name' => '絵画'
            ],
            [
                'category_id' =>  3,
                'name' => '音楽'
            ],
            [
                'category_id' =>  3,
                'name' => '動画'
            ],
            [
                'category_id' =>  3,
                'name' => '3D・アニメーション'
            ],
            [
                'category_id' =>  3,
                'name' => '映画'
            ],
            [
                'category_id' =>  3,
                'name' => 'その他'
            ],
            [
                'category_id' =>  4,
                'name' => '投資・株・不動産'
            ],
            [
                'category_id' =>  4,
                'name' => '仮想通貨・ブロックチェーン'
            ],
            [
                'category_id' =>  4,
                'name' => '貯金・保険'
            ],
            [
                'category_id' =>  4,
                'name' => '税金・年金'
            ],
            [
                'category_id' =>  4,
                'name' => '簿記・FP'
            ],
            [
                'category_id' =>  4,
                'name' => 'その他'
            ],
            [
                'category_id' =>  5,
                'name' => '英語'
            ],
            [
                'category_id' =>  5,
                'name' => '中国語'
            ],
            [
                'category_id' =>  5,
                'name' => '韓国語'
            ],
            [
                'category_id' =>  5,
                'name' => 'フランス語'
            ],
            [
                'category_id' =>  5,
                'name' => 'スペイン語'
            ],
            [
                'category_id' =>  5,
                'name' => 'その他'
            ],
            [
                'category_id' =>  6,
                'name' => 'ビジネスコミュニケーション'
            ],
            [
                'category_id' =>  6,
                'name' => 'チーム・マネジメント'
            ],
            [
                'category_id' =>  6,
                'name' => 'ビジネス戦略'
            ],
            [
                'category_id' =>  6,
                'name' => 'プロジェクト管理'
            ],
            [
                'category_id' =>  6,
                'name' => '営業・販売'
            ],
            [
                'category_id' =>  6,
                'name' => 'ビジネスマナー'
            ],
            [
                'category_id' =>  6,
                'name' => 'その他'
            ],
            [
                'category_id' =>  7,
                'name' => 'デジタルマーケティング'
            ],
            [
                'category_id' =>  7,
                'name' => 'SEO'
            ],
            [
                'category_id' =>  7,
                'name' => 'SNSマーケティング'
            ],
            [
                'category_id' =>  7,
                'name' => 'ブランディング'
            ],
            [
                'category_id' =>  7,
                'name' => 'PR・広告'
            ],
            [
                'category_id' =>  7,
                'name' => 'コンテンツマーケティング'
            ],
            [
                'category_id' =>  7,
                'name' => 'マスマーケティング'
            ],
            [
                'category_id' =>  7,
                'name' => 'グロースハック'
            ],
            [
                'category_id' =>  7,
                'name' => 'CRM'
            ],
            [
                'category_id' =>  7,
                'name' => 'ライティング・編集'
            ],
            [
                'category_id' =>  7,
                'name' => 'その他'
            ],
            [
                'category_id' =>  8,
                'name' => '筋トレ・ストレッチ'
            ],
            [
                'category_id' =>  8,
                'name' => 'スポーツ・エクササイズ'
            ],
            [
                'category_id' =>  8,
                'name' => '美容'
            ],
            [
                'category_id' =>  8,
                'name' => '食事・料理'
            ],
            [
                'category_id' =>  8,
                'name' => 'メンタルヘルス'
            ],
            [
                'category_id' =>  8,
                'name' => '睡眠・休息'
            ],
            [
                'category_id' =>  8,
                'name' => 'その他'
            ],
            [
                'category_id' =>  9,
                'name' => '観光'
            ],
            [
                'category_id' =>  9,
                'name' => '育児'
            ],
            [
                'category_id' =>  9,
                'name' => '工作・DIY'
            ],
            [
                'category_id' =>  9,
                'name' => 'その他'
            ],
        ];
        foreach($specialties as $specialty) {
            DB::table('specialties')->insert($specialty);
        }
    }
}
