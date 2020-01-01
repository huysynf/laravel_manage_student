<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Models\Subject::class, function (Faker $faker) {
    return [
        'name'=>'Môn học'.$faker->numberBetween(1,100),
        'lesson'=>$faker->numberBetween(1,100),
        'description'=>$faker->text,
    ];
});
