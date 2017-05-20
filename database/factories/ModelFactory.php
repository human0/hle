<?php
use Carbon\Carbon;
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
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Event::class, function (Faker\Generator $faker) {
	$c_time = Carbon::now();
    $users = App\User::pluck('id')->toArray();
    return [
        'user_id' => $faker->randomElement($users),
        'name' => $faker->unique()->name,
        'description' => $faker->realText(50),
        'start' => $c_time->addDays(rand(0,6))->toDateTimeString(),
        'end' => $c_time->addHours(rand(0,6))->toDateTimeString(),
        'location' => $faker->realText(50),
    ];
});