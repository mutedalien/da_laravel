<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\BlogPost;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

// создаем пост

$factory->define(BlogPost::class, function (Faker $faker) {
    $title = $faker->sentence(rand(3, 8), true);    //  sentence - длинна предложения
    $txt = $faker->realText(rand(1000, 4000));
    $isPublished = rand(1, 5) > 1;

    $data = [
        'category_id'   => rand(1, 11),
        'user_id'       => (rand(1, 5) == 5) ? 1 : 2,
        'title'         => $title,
        'slug'          => Str::slug($title),
        'excerpt'       => $faker->text(rand(40, 100)),
        'content_raw'   => $txt,
        'content_html'  => $txt,
        'is_published'  => $isPublished,
        'published_at'  => $isPublished ? $faker->dateTimeBetween('-2 monts', '-1 days') : null,
    ];
    return $data;
});
