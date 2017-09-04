<?php

$factory->define(App\Reason::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
    ];
});
