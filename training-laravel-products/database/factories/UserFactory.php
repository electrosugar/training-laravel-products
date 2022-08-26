<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'username' => 'electrosugar',
            'password' => '$2a$12$c8ykswn36fA8/NP5sFV5W.hxtUSkXIWrIVHLjvsZ4eMExlHGJC18q', // password
            'remember_token' => '$2a$12$c8ykswn36fA8/NP5sFV5W.hxtUSkXIWrIVHLjvsZ4eMExlHGJC18q'
        ];
    }

}
