<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use function Symfony\Component\String\width;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $this->faker->addProvider(new \Smknstd\FakerPicsumImages\FakerPicsumImagesProvider($this->faker));
        return [
            'title'=> $this->faker->word(),
            'description'=> $this->faker->sentence(),
            'price'=>$this->faker->randomFloat(2, 1, 10000),
//            'image_path'=>'storage/images/' . $this->faker->unique()->word() . '.png'
            'image_path'=>str_replace('public\\', '', $this->faker->image($dir='public\storage\images', $width=100, $height=100, $fullPath = true) )
        ];
    }
}
