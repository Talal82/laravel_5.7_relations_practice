<?php

use Faker\Generator as Faker;
use App\SubCategory;

$factory->define(SubCategory::class, function (Faker $faker) {
    return [
        'name' => $faker -> name,
        'slug' => str_slug($faker -> unique() -> name, '-'),
        'category_id' => $faker -> numberBetween(1,25),
    ];
});
