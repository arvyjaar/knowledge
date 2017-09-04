<?php

$factory->define(App\Organisation::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
    ];
});
