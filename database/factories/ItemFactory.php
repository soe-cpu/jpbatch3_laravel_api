<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
    	'codeno' => $faker->uniqid(),
        'name' => $faker->name,
        'price' => $faker->price,
        'discount' => $faker->discount,
        'description' => $faker->description,
        
        
        'remember_token' => Str::random(10),
    ];
});
