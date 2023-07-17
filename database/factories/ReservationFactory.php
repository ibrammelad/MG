<?php

namespace Database\Factories;

use App\Models\Table;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $startTime = $this->faker->time('H:i:s');
        $endTime = date('H:i:s', strtotime('+1 hours', strtotime($startTime)));

        return [
            'table_id' => Table::all()->random()->id,
            'customer_id' => Customer::all()->random()->id,
            'from_time' => $startTime,
            'to_time' => $endTime,
        ];
    }
}
