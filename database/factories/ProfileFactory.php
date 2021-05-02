<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {

    $category_id = $faker->numberBetween(1, 9);
    $specialty_id;

    switch($category_id) {
        case 1:
            $specialty_id = 1;
            break;
        case 2:
            $specialty_id = $faker->numberBetween(2, 10);
            break;
        case 3:
            $specialty_id = $faker->numberBetween(11, 24);
            break;
        case 4:
            $specialty_id = $faker->numberBetween(25, 30);
            break;
        case 5:
            $specialty_id = $faker->numberBetween(31, 36);
            break;
        case 6:
            $specialty_id = $faker->numberBetween(37, 43);
            break;
        case 7:
            $specialty_id = $faker->numberBetween(44, 54);
            break;
        case 8:
            $specialty_id = $faker->numberBetween(55, 61);
            break;
        case 9:
            $specialty_id = $faker->numberBetween(62, 65);
            break;
    }


    return [
        'user_id' => function() {
            return factory(App\Models\User::class)->create()->id;
        },
        'category_id' => $category_id,
        'specialty_id' => $specialty_id,
        'catch_copy' => $faker->sentence(rand(2,3)),
        'description' => 'これはダミーユーザーのデータです。データが登録されたユーザーは[こちら](/users/1)',
    ];
});
