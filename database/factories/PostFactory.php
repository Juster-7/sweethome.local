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
		return [
            'meta_description' => $this->faker->realText(mt_rand(10, 200)),
			'meta_keyword' => implode(', ', $this->faker->words(mt_rand(3,7))),
			'title' => $this->faker->realText(mt_rand(20, 100)),
			//'slug' => slug заполнятеся автоматически с sluggable
			'title_image' => 'post-'.mt_rand(1, 6).'.jpg',
			'intro_text' => $this->faker->realText(mt_rand(50, 100)),
			'main_text' => FactoryHelper::getFakerHTMLText($this->faker, mt_rand(3, 10)),
			'hits' => mt_rand(0, 1000),
			'date_show' => $this->faker->dateTimeBetween($startDate = '-1 year', $endDate = '+1 day'),
			'user_id' => mt_rand(1, 60),
			'post_category_id' => mt_rand(1, 10)
        ];
    }
}
