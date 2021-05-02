<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    // $faker_en = \Faker\Factory::create('en_US');

    $category_id;
    $specialty_id;

    $num = mt_rand(1, 100);

    if(0 < $num && $num <= 17) {
        $category_id = 2;
    } else if(17 < $num && $num <= 33) {
        $category_id = 3;
    } else if(33 < $num && $num <= 44) {
        $category_id = 4;
    } else if(44 < $num && $num <= 61) {
        $category_id = 5;
    } else if(61 < $num && $num <= 71) {
        $category_id = 6;
    } else if(71 < $num && $num <= 88) {
        $category_id = 7;
    } else if(88 < $num && $num <= 96) {
        $category_id = 8;
    } else if(96 < $num && $num <= 99){
        $category_id = 9;
    } else {
        $category_id = 0;
    }


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
        default:
            $specialty_id = 0;
    }

    $date = $faker->dateTimeBetween('-2 years', '-1 day');

    return [
        'user_id' => $faker->numberBetween(3, 100),
        'category_id' => $category_id,
        'specialty_id' => $specialty_id,
        'release_status' => 1,
        // 'title' => $faker->sentence(rand(3,4)),
        'title' => '[dummy] ' . $faker->realText(rand(10, 20)),
        'description' => 'これはダミーの投稿です。データが登録された投稿は[こちら](/roadmaps/1)',
        'eye_catch_url' => config('app.image_url') . "/img/post/eye_catch/post_" . Str::uuid() . ".jpg",
        'created_at' => $date,
        'updated_at' => $date,
    ];
});
