<?php

$factory->define(App\Appeal::class, function (Faker\Generator $faker) {
    return [
        "description" => $faker->name,
        "report" => $faker->name,
        "appellant" => $faker->name,
        "date" => $faker->date("Y-m-d", $max = 'now'),
        "court_decision_id" => factory('App\CourtDecision')->create(),
    ];
});
