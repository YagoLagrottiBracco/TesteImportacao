<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Client;

class ClientFactory extends Factory
{
    protected $model = Client::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'document' => $this->faker->unique()->numberBetween(00000000000, 99999999999),
            'city' => 'São José do Rio Preto',
            'state' => 'SP',
            'start_date' => $this->faker->dateTimeThisMonth(),
        ];
    }
}
