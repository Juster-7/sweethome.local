<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
	use DatabaseMigrations;
    
	protected $role;
	
	protected function setUp():void {
		parent::setUp();
		
		$this->role = Role::factory()->create();
		Event::fake();
	}
	
	/** @test */
    public function test_user_registered_successfully() {		
		$user = [
			'role_id' => $this->role,
			'name' => 'Иванов Иван',
			'email' => 'test@email.ru',
			'password' => 'password',
			'password_confirmation' => 'password',
		];
		
		$response = $this->post(route('user.register'), $user);		
		$users = User::all();
		$user = $users->first();		
		
        $this->assertCount(1, $users);
        $this->assertDatabaseCount('users', 1);
        $this->assertAuthenticatedAs($user);
        $this->assertEquals('Иванов Иван', $user->name);
        $this->assertEquals('test@email.ru', $user->email);
        $this->assertTrue(Hash::check('password', $user->password));
		Event::assertDispatched(Registered::class, function ($e) use ($user) {
			return $e->user->id === $user->id;
		});
    }
	
	/** @test */
    public function test_user_registration_without_name_validated() {
		$user = [
			'role_id' => $this->role,
			'name' => '',
			'email' => 'test@email.ru',
			'password' => 'password',
			'password_confirmation' => 'password',
		];
	
		$response = $this->post(route('user.register'), $user);
		$users = User::all();
		
        $this->assertCount(0, $users);
        $this->assertGuest();
        $response->assertSessionHasErrors('name');
        Event::assertNotDispatched(Registered::class);
    }
}
