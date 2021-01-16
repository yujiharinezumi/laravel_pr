<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

//ブログモデルを呼び出す
use App\Models\Blog;
use Faker\Generator as Faker;

$factory->define(Blog::class, function (Faker $faker) {
    return [
        //
        'title' => $faker->word,
        'content' => $faker->realText

    ];
});
