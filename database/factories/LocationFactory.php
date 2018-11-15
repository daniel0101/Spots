<?php

use Faker\Generator as Faker;
use App\Location;
$factory->define(Location::class, function (Faker $faker) {
    return [
        'id'=>$faker->unique()->randomDigit,
        'name'=>$faker->city
    ];
});
