<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        return [
			'product_id' => mt_rand(1, 40),
			'name' => $this->faker->realText(mt_rand(20, 50)),
			'alias' => Str::random(32),
			'intro_text' => $this->faker->realText(mt_rand(40, 70)),
			'main_text' => FactoryHelper::getFakerHTMLText($this->faker, mt_rand(2, 10)),
			'price' => $this->faker->randomFloat(2, 100, 10000),
			'quantity' => mt_rand(1, 10),
        ];
    }
}
