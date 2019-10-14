<?php

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'username' => $faker->unique()->userName,
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => password_hash('test123', PASSWORD_BCRYPT),
        'nisn' => $faker->randomNumber(),
        'nip' => $faker->randomNumber(),
        'gender' => $faker->numberBetween(0, 2),
        'address' => $faker->address,
        'dob' => $faker->date()
    ];
});
