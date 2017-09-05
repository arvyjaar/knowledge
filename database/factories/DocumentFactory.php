<?php

$factory->define(App\Document::class, function (Faker\Generator $faker) {
    return [
        "nr" => $faker->name,
        "title" => $faker->name,
        "description" => $faker->name,
        "signed" => $faker->date("Y-m-d", $max = 'now'),
        "valid_from" => $faker->date("Y-m-d", $max = 'now'),
        "valid_till" => $faker->date("Y-m-d", $max = 'now'),
        "category_id" => factory('App\Doccategory')->create(),
        "organisation_id" => factory('App\Organisation')->create(),
        "department_id" => factory('App\Department')->create(),
        "changed_id" => factory('App\Document')->create(),
    ];
});
