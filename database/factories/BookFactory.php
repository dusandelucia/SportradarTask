<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\books;
use Faker\Generator as Faker;

$factory->define(books::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'releaseDate' => $faker->date(),
        'author_id' => $faker->numberBetween(0, 9)
    ];
});
