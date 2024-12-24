<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

class ApiUsersTest extends TestCase
{
	use LazilyRefreshDatabase;
	
	public function createUser():void {
		User::factory()
			->for(Role::factory()->create())
			->create([
				'name' => 'Иванов Иван',
				'email' => 'test@email.ru',
				'password' => Hash::make('password'),
			]);
	}	

	/** @test */
    public function test_user_registered_successfully() {
		$role = Role::factory()->create();
		$user = [
			'role_id' => $role->id,
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
		$role = Role::factory()->create();
		$user = [
			'role_id' => $role->id,
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
		$this->createUser();	

		$testUser = [
			'email' => 'test@email.ru',
			'password' => 'password'
		];		
		
		return $this->json('post', '/api/login', $testUser)
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
		$this->createUser();		
		
		$testUser = [
			'email' => 'test@email.ru',
			'password' => 'wrongPassword'
		];
		
		$expected_response = [
			'success' => false,
			'message' => 'User is unauthorised'
		];
		
		return $this->json('post', '/api/login', $testUser)
			->assertStatus(401)
			->assertJson( $expected_response );		
    }
}
