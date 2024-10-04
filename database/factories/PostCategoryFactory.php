<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PostCategory>
 */
class PostCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $titles = ['Ванная', 'Кухня', 'Гостиная', 'Спальня', 'Балкон', 'Прихожая', 'Декор', 'Туалет', 'Детская', 'Дизайн'];
        return [
			'title' => $this->faker->unique()->randomElement($titles),
			'css_color_class' => 'cat-'.$this->faker->unique()->numberBetween(1,10),
			//'slug' => slug заполнятеся автоматически с sluggable
        ];
    }
}
