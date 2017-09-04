<?php

$factory->define(App\Question::class, function (Faker\Generator $faker) {
    return [
        "question" => $faker->name,
        "answer" => $faker->name,
        "approved" => 0,
        "author" => $faker->name,
        "category_id" => factory('App\Category')->create(),
        "department_id" => factory('App\Department')->create(),
    ];
});
