<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    // TEST用データ作成
    public function definition(): array
    {
        return [
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password123'),
            'email_verified_at' => '2025-02-12 17:36:24',
        ];
    }
}
