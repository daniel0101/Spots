<?php

use App\Spot;
use Faker\Generator as Faker;

$factory->define(Spot::class, function (Faker $faker) {
    return [
        'user_id'=>function(){
            return factory('App\User')->create()->id;
        },
        'location_id'=> function(){
            return factory('App\Location')->create()->id;
        },
        'name'=>$faker->name,
        'address'=>$faker->address,
        'phone_no'=>$faker->phoneNumber,
        'avatar'=>$faker->imageUrl($width = 640, $height = 480)
    ];
});
