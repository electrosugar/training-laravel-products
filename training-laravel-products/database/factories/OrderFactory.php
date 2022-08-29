<?php

namespace Database\Factories;

use App\Models\ArchivedProduct;
use App\Models\Customer;
use App\Models\Product;
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
        $products = ArchivedProduct::all()->pluck('id')->toArray();
        $customers = Customer::all()->pluck('id')->toArray();
        return [
            'archived_product_id' => $this->faker->randomElement($products),
            'customer_id' => $this->faker->randomElement($customers)
        ];
    }
}
