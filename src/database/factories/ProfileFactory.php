<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    public function definition(): array
    {
        $postCodeBase = $this->faker->postcode();
        $postCode = substr($postCodeBase, 0, 3) . "-" . substr($postCodeBase, 3, 4);

        $address = $this->faker->prefecture() . $this->faker->city() . $this->faker->streetAddress();

        return [
            'user_id'     => $this->faker->numberBetween(1, 5),
            'name'        => $this->faker->name(),
            'post_number' => $postCode,
            'address'     => $address,
            'building'    => $this->faker->secondaryAddress(),
            'img_url'     => "",
        ];
    }
}
