<?php

/*
|--------------------------------------------------------------------------
| Palestra Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/


$factory->define(App\Palestrantes::class, function (Faker\Generator $faker) {
    return [
        'palestrante_id' => $faker->numberBetween(0,999), //$faker->name,
        'palestrante_nome' => $faker->name,
    	
    ];
});
