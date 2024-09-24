<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
	$titles = ['Вазы', 'Керамика', 'Подушки', 'Краски', 'Тарелки', 'Декор', 'Картины', 'Книги', 'Часы', 'Ковры'];
        return [
			'title' => $this->faker->randomElement($titles),
			//'slug' => slug заполнятеся автоматически с sluggable
			'main_text' => FactoryHelper::getFakerHTMLText($this->faker, mt_rand(2, 10)),
        ];
	}
}
