<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ApiUsersTest extends TestCase
{
	use DatabaseMigrations;
	
	/** @test */
    public function test_user_registered_successfully() {
		Role::create([ 'name' => 'Администратор' ]);
        Role::create([ 'name' => 'Модератор' ]);
        Role::create([ 'name' => 'Автор' ]);
        Role::create([ 'name' => 'Пользователь' ]);
	
		$user = [
			'name' => 'Иванов Иван',
			'email' => 'test@email.ru',
			'password' => 'password',
			'confirm_password' => 'password',
		];		
		
		return $this->json('post', '/api/register', $user)
			->assertStatus(201)
			->assertJsonStructure([
				'data' => [
					'token',
					'name',
					'email'
				]
			]
		);		
    }
	
	/** @test */
    public function test_user_register_without_name_validated() {
		Role::factory()->count(4)->create();
	
		$user = [
			'name' => '',
			'email' => 'test@email.ru',
			'password' => 'password',
			'confirm_password' => 'password',
		];		
		
		$expected_response = [
            'success' => false,
            'message' => 'Validation Error',
            'data'    => [
				'name' => [ 'Поле Имя обязательно для заполнения.' ]
			]
        ]; 
		
		return $this->json('post', '/api/register', $user)
			->assertStatus(400)
			->assertJson($expected_response);		
    }
	
	/** @test */
    public function test_user_logged_in_successfully() {
		Role::factory()->create();
		User::create([
			'role_id' => 1,
			'name' => 'Иванов Иван',
			'email' => 'test@email.ru',
			'password' => Hash::make('password'),
		]);		
	
		$user = [
			'email' => 'test@email.ru',
			'password' => 'password'
		];		
		
		return $this->json('post', '/api/login', $user)
			->assertStatus(200)
			->assertJsonStructure([
				'data' => [
					'token',
					'name',
					'email'
				]
			]
		);		
    }
	
	/** @test */
    public function test_user_login_failed_unauthorised() {
		Role::factory()->create();
		User::create([
			'role_id' => 1,
			'name' => 'Иванов Иван',
			'email' => 'test@email.ru',
			'password' => Hash::make('password'),
		]);		
	
		$user = [
			'email' => 'test@email.ru',
			'password' => 'password2'
		];		
		
		$expected_response = [
			'success' => false,
			'message' => 'User is unauthorised'
		];
		
		return $this->json('post', '/api/login', $user)
			->assertStatus(401)
			->assertJson( $expected_response );		
    }
}
