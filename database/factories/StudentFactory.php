<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Models\Student::class, function (Faker $faker) {
    return [
        'name'=>$faker->name,
        'address'=>$faker->address,
        'image'=>'default.jpg',
        'birthday'=>$faker->date('yyyy-mm-dd'),
        'phone'=>'111-2222-333',
        'gender'=>0,
    ];
});
