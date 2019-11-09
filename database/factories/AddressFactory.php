<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Address;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1,5),
        'name' => $faker->word,
        'country_id' => 229,
        'state_id' => 2,
        'city_id' => $faker->numberBetween(1,4),
        'street' => $faker->word,
    ];
});
