<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
		$titles = ['Администратор', 'Модератор', 'Автор', 'Пользователь'];
        
		return [
			'name' => $this->faker->unique()->randomElement($titles),
		];
    }
}
