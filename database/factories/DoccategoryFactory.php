<?php

$factory->define(App\Doccategory::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
        "description" => $faker->name,
    ];
});
