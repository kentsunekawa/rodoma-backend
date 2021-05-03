<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 5),
        'post_id' => 1,
        'comment' => '[dummy message] ' . $faker->sentence(rand(3,10)),
        'created_at' => $faker->dateTimeBetween('-10 day', '-1 day'),
        'updated_at' => $faker->dateTimeBetween('-10 day', '-1 day'),
    ];
});
