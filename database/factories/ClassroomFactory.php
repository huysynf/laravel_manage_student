<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Models\Classroom::class, function (Faker $faker) {
    return [
        'name'=>'Lớp học  '.$faker->numberBetween(1,100),
        'faculty_id'=>$faker->numberBetween(1,10),
        'description'=>$faker->address,
        'member'=>$faker->numberBetween(35,100),
        'subject_id'=>$faker->numberBetween(1,10),
    ];
});
