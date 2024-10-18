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
			'password' => Hash::make('11111111'),
		]);
        User::factory()->count(100)->create();        
    }
}
