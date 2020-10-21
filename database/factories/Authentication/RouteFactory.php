<?php

namespace Database\Factories\Authentication;

use App\Models\Authentication\Route;
use Illuminate\Database\Eloquent\Factories\Factory;

class RouteFactory extends Factory
{
    protected $model = Route::class;

    public function definition()
    {
        return [
            'uri' => $this->faker->url,
            'label' => $this->faker->word,
            'icon' => 'pi-ban',
            'order' => 1,
            'state_id' => 1,
        ];
    }
}
