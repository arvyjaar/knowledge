<?php

$factory->define(App\Department::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
    ];
});
