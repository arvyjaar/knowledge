<?php

$factory->define(App\Result::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
    ];
});
