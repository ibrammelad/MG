<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Meal>
 */
class MealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'price' =>$this->faker->numberBetween(50 , 200) ,
            'description' => $this->faker->word(),
            'quantity_available'=>$this->faker->numberBetween(3 , 30) ,
            'discount'=>$this->faker->numberBetween(1 , 100) ,
        ];
    }
}
