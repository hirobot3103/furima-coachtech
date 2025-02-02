<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(1,5),
            'item_id' => $this->faker->numberBetween(1,10),
            'comment' => $this->faker->realText()
        ];
    }
}
