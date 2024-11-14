<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
		$dateTime = $this->faker->dateTimeBetween($startDate = '-1 year', $endDate = '+1 day');
		$titles = ['post', 'product'];
        return [
			'commentable_id' => mt_rand(1, 250),
			'commentable_type' => $this->faker->randomElement($titles),
			'parent_id' => null, //$this->faker->optional()->numberBetween(1,1500),
			'user_id' => mt_rand(1, 60),			
			'text' => $this->faker->realText(mt_rand(20, 300)),
			'created_at' => $dateTime,
			'updated_at' => $dateTime,
        ];
    }
}
