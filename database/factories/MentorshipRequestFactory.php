<?php

use Faker\Generator as Faker;

$factory->define(\App\MentorshipRequest::class, function (Faker $faker) {
    $for = ['mentor', 'mentee'];
    return [
        'for' => $for[array_rand($for)],
        'description' => $faker->sentence(2),
        'pairing_time' => '22:00', // secret
        'session_duration' => 60,
        'mentorship_duration' => 120,
        'days' => 1111111,
        'user_id' => function () {
            return factory(\App\User::class)->create()->id;
        }
    ];
});
