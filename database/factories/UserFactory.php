<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
		$userName = $this->faker->name();
		$fileName = Str::random(40).'.jpg';
		$url = 'https://ui-avatars.com/api/?background='.str_replace('#','',$this->faker->hexcolor()).'&size=120&name='.$userName;
		$content = http::get($url)->body();
		Storage::disk('profile-photos')->put($fileName, $content);
		
        return [
            'name' => $userName,
            'photo' => $fileName,
            'email' => $this->faker->unique()->safeEmail(),
            'role_id' => mt_rand(2, 4),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
