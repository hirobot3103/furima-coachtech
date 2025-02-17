<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    
    private static int $sequence = 1;

    public function definition(): array
    {

        $userId       = self::$sequence++;
        $userName     = 'user' . $userId;  
        $postCodeBase = $this->faker->postcode();
        $postCode     = substr($postCodeBase, 0, 3) . "-" . substr($postCodeBase, 3, 4);
        $address      = $this->faker->prefecture() . $this->faker->city() . $this->faker->streetAddress();

        return [
            'user_id'     => $userId,
            'name'        => $userName,
            'post_number' => $postCode,
            'address'     =>  $address,
            'building'    => $this->faker->secondaryAddress(),
            'img_url'     => "",
            'prof_reg'    => 1,
        ];
    }
}
