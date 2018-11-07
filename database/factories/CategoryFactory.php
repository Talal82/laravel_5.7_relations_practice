<?php

use Faker\Generator as Faker;
use App\Category;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker -> unique() -> name,
        'slug' => str_slug( $faker -> name , '-'),
    ];
});
