<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *	 
     * @return array<string, mixed>
     */
    public function definition() {
		$themes = ['Спальня', 'Гостиная', 'Ванная', 'Кухня', 'Прихожая', 'Балкон'];
        return [
            'title' => $this->faker->realText(mt_rand(20, 100)),
			'alias' => Str::random(32),
			'author' => $this->faker->name(),
			'image_name' => 'post-'.mt_rand(1, 6).'.jpg',
			'theme' => $this->faker->randomElement($themes),
			'intro_text' => $this->faker->realText(mt_rand(50, 100)),
			'main_text' => FactoryHelper::getFakerHTMLText($this->faker, mt_rand(3, 10)),
			'meta_description' => $this->faker->realText(mt_rand(10, 200)),
			'meta_keyword' => implode(', ', $this->faker->words(mt_rand(3,7))),
			'hits' => mt_rand(0, 1000),
			'date_show' => $this->faker->dateTimeBetween($startDate = '-1 year', $endDate = '+1 day')
        ];
    }
}
