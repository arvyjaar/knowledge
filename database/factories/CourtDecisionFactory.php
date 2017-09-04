<?php

$factory->define(App\CourtDecision::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
    ];
});
