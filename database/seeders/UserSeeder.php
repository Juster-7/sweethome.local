<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		User::factory()->create([
			'name' => 'Алексей Шелег',
			'email' => 'q@q.q',
			'role_id' => 1,
			'password' => Hash::make('11111111'),
			'photo' => 'N7sTnTGzaBJoiZP2yNwsB3U578iULuNGxxGNzh3q.jpg',
		]);
        User::factory()->count(99)->create();        
    }
}
