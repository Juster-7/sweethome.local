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
        return [
			'post_id' => mt_rand(1, 60),
			'parent_id' => null,
			'name' => $this->faker->name(),
			'email' => $this->faker->unique()->safeEmail(),
			'text' => $this->faker->realText(mt_rand(20, 300)),
			'access_token' => Str::random(32),
			'created_at' => $dateTime,
			'updated_at' => $dateTime,
        ];
    }
}
