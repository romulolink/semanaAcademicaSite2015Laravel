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


$factory->define(App\Palestras::class, function (Faker\Generator $faker) {
    return [
        'palestra_id' => $faker->numberBetween(0,999), //$faker->name,
        'palestra_titulo' => $faker->name,
    	'palestra_resumo' => $faker->text,
    	'palestra_data' => $faker->dateTime,
    	'palestrante_id' => $faker->numberBetween(0, 3),
    	'palestra_categoria' => $faker->name,	
    ];
});
