<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Models\Faculty::class, function (Faker $faker) {
    return [
        'name'=>'khoa cong nghe thong tin'.$faker->randomNumber(1,100),
        'description'=>$faker->text,
    ];
});
