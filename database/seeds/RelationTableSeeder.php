<?php

use Illuminate\Database\Seeder;
use App\Models\Relation;

class RelationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $relations = [
        //     [
        //         'follower_id' => 1,
        //         'followed_id' => 2,
        //     ],
        // ];

        for($i = 0; $i < 100; $i++) {
            if($i + 1 !== 101) {
                Relation::create([
                    'follower_id' => 101,
                    'followed_id' => $i + 1,
                ]);
                if($i % 2 === 0) {
                    Relation::create([
                        'follower_id' => $i + 1,
                        'followed_id' => 101,
                    ]);
                }
            }
        }
        // foreach($relations as $relation) {

        //     Relation::create($relation);
        // }
    }
}
