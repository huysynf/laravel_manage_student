<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Models\Faculty::class, function (Faker $faker) {
    return [
        'name'=>'Khoa công nghệ thông tin'.$faker->numberBetween(1,100),
        'description'=>$faker->text,
    ];
});
