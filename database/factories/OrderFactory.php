<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Reservation;
use App\Models\Table;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'table_id' => Table::all()->random()->id,
            'customer_id' => Customer::all()->random()->id,
            'reservation_id' => Reservation::all()->random()->id,
            'total'=>$this->faker->numberBetween(1 , 1000) ,
            'paid'=>$this->faker->boolean ,
            'date'=>$this->faker->dateTimeThisCentury->format('Y-m-d')
        ];
    }
}
