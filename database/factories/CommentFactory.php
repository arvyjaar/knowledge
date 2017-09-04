<?php

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    return [
        "question_id" => factory('App\Question')->create(),
        "name" => $faker->name,
        "email" => $faker->safeEmail,
        "text" => $faker->name,
    ];
});
