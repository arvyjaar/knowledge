<?php

$factory->define(App\Category::class, function (Faker\Generator $faker) {
    return [
        "category" => $faker->name,
        "description" => $faker->name,
        "department_id" => factory('App\Department')->create(),
    ];
});
