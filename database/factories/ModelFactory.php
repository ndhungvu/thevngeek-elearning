<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'fullname' => $faker->name,
        'nickname' => $faker->userName,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = '123456',
        'phone' => $faker->phoneNumber,
        'facebook_link' => $faker->url,
        'linkedin_link' => $faker->url,
        'github_link' => $faker->url,
        'stackoverflow_link' => $faker->url,
        'skill' => $faker->word,
        'rank' => $faker->numberBetween(0, 4),
        'role' => $faker->numberBetween(2, 3),
        'status' => $faker->numberBetween(0, 1),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text(200),
        'image' => $faker->imageUrl(),
    ];
});

$factory->define(App\Document::class, function (Faker\Generator $faker) {
    static $userIds;

    return [
        'name' => $faker->sentence,
        'alias' => $faker->word,
        'description' => $faker->text(200),
        'link' => $faker->url,
        'status' => $faker->numberBetween(1, 3),
        'user_id' => $faker->randomElement($userIds ?: \App\User::all()->pluck('id')->toArray())
    ];
});

$factory->define(App\Article::class, function (Faker\Generator $faker) {
    static $userIds;

    return [
        'name' => $faker->sentence,
        'alias' => $faker->word,
        'description' => $faker->text(200),
        'content' => $faker->text(200),
        'user_id' => $faker->randomElement($userIds ?: \App\User::all()->pluck('id')->toArray())
    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    static $userIds;
    static $articleIds;
    static $documentIds;

    $type = $faker->numberBetween(1, 2);

    $objectId = ($type == 1 ? $faker->randomElement($articleIds ?: \App\Article::all()->pluck('id')->toArray())
        : $faker->randomElement($documentIds ?: \App\Document::all()->pluck('id')->toArray()));

    return [
        'content' => $faker->text(200),
        'type' => $type,
        'status' => $faker->numberBetween(1, 3),
        'object_id' => $objectId,
        'user_id' => $faker->randomElement($userIds ?: \App\User::all()->pluck('id')->toArray())
    ];
});
