<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(99, 101),
        'post_id' => 1,
        'comment' => $faker->sentence(rand(3,10)),
        'created_at' => new DateTime('now'),
        'updated_at' => new DateTime('now'),
    ];
});
