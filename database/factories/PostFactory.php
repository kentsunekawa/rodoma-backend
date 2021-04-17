<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => 101,
        'category_id' => 2,
        'specialty_id' => 2,
        'release_status' => $faker->numberBetween(0, 2),
        'title' => $faker->sentence(rand(1,4)),
        'description' => $faker->realText(512),
        'eye_catch_url' => config('app.image_url') . "/img/post/eye_catch/default.jpg",
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
