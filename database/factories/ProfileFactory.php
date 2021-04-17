<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            return factory(App\Models\User::class)->create()->id;
        },
        'category_id' => 6,
        'specialty_id' => $faker->numberBetween(22, 26),
        'catch_copy' => 'キャッチコピー',
        'description' => '自己紹介文',
    ];
});
