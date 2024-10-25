<?php

namespace Tests\Feature;

use App\Http\Resources\ProductResource;
use App\Models\Role;
use App\Models\User;
use App\Models\Brand;
use App\Models\ProductCategory;
use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ApiProductsTest extends TestCase
{
	use DatabaseMigrations;
	
	/** @test */
    public function test_products_retrieved_successfully() {
		ProductCategory::factory()->create();
		Brand::factory()->create();
		Product::factory()->create([ 
			'title' => 'Название 1', 
			'product_category_id' => 1, 
			'brand_id' => 1, 
			'price' => 5, 
		]);
		Product::factory()->create([ 
			'title' => 'Название 2', 
			'product_category_id' => 1, 
			'brand_id' => 1,
			'price' => 10.5,			
		]);
		
		Role::create([ 'name' => 'Администратор' ]);
		$user = User::create([
			'role_id' => 1,
			'name' => 'Иванов Иван',
			'email' => 'test@email.ru',
			'password' => Hash::make('password'),
		]);
		$token = $user->createToken('access_token')->plainTextToken;
		
		$headers = [
			'Accept' => 'application/json',
			'Authorization' => "Bearer $token"
		];
		
		$expected_response = [
            'success' => true,
            'message' => 'Products retrieved successfully',
            'data'    => [
				[ 'created_at' => Date('d/m/Y'), 'id' => 1, 'price' => 5, 'title' => 'Название 1', 'updated_at' => Date('d/m/Y') ],
				[ 'created_at' => Date('d/m/Y'), 'id' => 2, 'price' => 10.5, 'title' => 'Название 2', 'updated_at' => Date('d/m/Y') ]
			]
        ]; 
				
		return $this->withHeaders($headers)->json('get', '/api/products')
			->assertStatus(200)
			->assertJson( $expected_response )
			->assertJsonStructure([
				'data' => [[
					'id',
					'title',
					'price',
					'created_at',
					'updated_at',
				]]
			]
		);		
    }
	
	/** @test */
    public function test_product_created_successfully() {
		Role::create([ 'name' => 'Администратор' ]);
		$user = User::create([
			'role_id' => 1,
			'name' => 'Иванов Иван',
			'email' => 'test@email.ru',
			'password' => Hash::make('password'),
		]);
		$token = $user->createToken('access_token')->plainTextToken;
		
		$headers = [
			'Accept' => 'application/json',
			'Authorization' => "Bearer $token"
		];
		
		ProductCategory::factory()->create();
		Brand::factory()->create();
		$product = [
			'title' => 'Часы Certina',
			'price' => 35.5,
			'product_category_id' => 1,
			'brand_id' => 1,
		];
		
		$expected_response = [
            'success' => true,
            'message' => 'Product created successfully',
            'data'    => [
				'id' => 1, 
				'title' => 'Часы Certina', 
				'price' => 35.5, 
				'created_at' => Date('d/m/Y'), 
				'updated_at' => Date('d/m/Y') 
			]
        ]; 
				
		return $this->withHeaders($headers)->json('post', '/api/products', $product)
			->assertStatus(201)
			->assertJson($expected_response);		
    }
	
	/** @test */
    public function test_product_create_without_title_validated() {
		Role::create([ 'name' => 'Администратор' ]);
		$user = User::create([
			'role_id' => 1,
			'name' => 'Иванов Иван',
			'email' => 'test@email.ru',
			'password' => Hash::make('password'),
		]);
		$token = $user->createToken('access_token')->plainTextToken;
		
		$headers = [
			'Accept' => 'application/json',
			'Authorization' => "Bearer $token"
		];
		
		ProductCategory::factory()->create();
		Brand::factory()->create();
		$product = [
			'title' => '',
			'price' => 35.5,
			'product_category_id' => 1,
			'brand_id' => 1,
		];
		
		$expected_response = [
            'success' => false,
            'message' => 'Validation Error',
            'data'    => [
				'title' => [ 'Поле Наименование обязательно для заполнения.' ]
			]
        ]; 
				
		return $this->withHeaders($headers)->json('post', '/api/products', $product)
			->assertStatus(400)
			->assertJson($expected_response);		
    }
	
	/** @test */
    public function test_product_retrieved_successfully() {
		ProductCategory::factory()->create();
		Brand::factory()->create();
		Product::factory()->create([
			'title' => 'Часы Certina',
			'price' => 35.5,
			'product_category_id' => 1,
			'brand_id' => 1,
		]);
		
		Role::create([ 'name' => 'Администратор' ]);
		$user = User::create([
			'role_id' => 1,
			'name' => 'Иванов Иван',
			'email' => 'test@email.ru',
			'password' => Hash::make('password'),
		]);
		$token = $user->createToken('access_token')->plainTextToken;
		
		$headers = [
			'Accept' => 'application/json',
			'Authorization' => "Bearer $token"
		];
		
		$expected_response = [
            'success' => true,
            'message' => 'Product retrieved successfully',
            'data'    => [
				'id' => 1, 
				'title' => 'Часы Certina', 
				'price' => 35.5, 
				'created_at' => Date('d/m/Y'), 
				'updated_at' => Date('d/m/Y') 
			]
        ];  
				
		return $this->withHeaders($headers)->json('get', '/api/products/1')
			->assertStatus(200)
			->assertJson($expected_response);
	}
	
	/** @test */
    public function test_product_not_found() {
		ProductCategory::factory()->create();
		Brand::factory()->create();
		Product::factory()->create([
			'title' => 'Часы Certina',
			'price' => 35.5,
			'product_category_id' => 1,
			'brand_id' => 1,
		]);
		
		Role::create([ 'name' => 'Администратор' ]);
		$user = User::create([
			'role_id' => 1,
			'name' => 'Иванов Иван',
			'email' => 'test@email.ru',
			'password' => Hash::make('password'),
		]);
		$token = $user->createToken('access_token')->plainTextToken;
		
		$headers = [
			'Accept' => 'application/json',
			'Authorization' => "Bearer $token"
		];
		
		$expected_response = [
            'success' => false,
            'message' => 'Product not found'
        ];  
				
		return $this->withHeaders($headers)->json('get', '/api/products/100')
			->assertStatus(404)
			->assertJson($expected_response);
	}
	
	/** @test */
    public function test_product_updated_successfully() {
		ProductCategory::factory()->create();
		Brand::factory()->create();
		Product::factory()->create([
			'title' => 'Часы Certina',
			'price' => 35.5,
			'product_category_id' => 1,
			'brand_id' => 1,
		]);
		
		Role::create([ 'name' => 'Администратор' ]);
		$user = User::create([
			'role_id' => 1,
			'name' => 'Иванов Иван',
			'email' => 'test@email.ru',
			'password' => Hash::make('password'),
		]);
		$token = $user->createToken('access_token')->plainTextToken;
		
		$headers = [
			'Accept' => 'application/json',
			'Authorization' => "Bearer $token"
		];
		
		$product = [
			'title' => 'Часы Rolex'
		];
		
		$expected_response = [
            'success' => true,
            'message' => 'Product updated successfully',
            'data'    => [
				'id' => 1, 
				'title' => 'Часы Rolex', 
				'price' => 35.5, 
				'created_at' => Date('d/m/Y'), 
				'updated_at' => Date('d/m/Y') 
			]
        ];  
				
		return $this->withHeaders($headers)->json('put', '/api/products/1', $product)
			->assertStatus(200)
			->assertJson($expected_response);
	}
	
	/** @test */
    public function test_product_update_without_title_validated() {
		ProductCategory::factory()->create();
		Brand::factory()->create();
		Product::factory()->create([
			'title' => 'Часы Certina',
			'price' => 35.5,
			'product_category_id' => 1,
			'brand_id' => 1,
		]);
		
		Role::create([ 'name' => 'Администратор' ]);
		$user = User::create([
			'role_id' => 1,
			'name' => 'Иванов Иван',
			'email' => 'test@email.ru',
			'password' => Hash::make('password'),
		]);
		$token = $user->createToken('access_token')->plainTextToken;
		
		$headers = [
			'Accept' => 'application/json',
			'Authorization' => "Bearer $token"
		];
		
		$product = [
			'title' => ''
		];
		
		$expected_response = [
            'success' => false,
            'message' => 'Validation Error',
            'data'    => [
				'title' => [ 'Наименование должен быть не меньше 1 символов.' ] 
			]
        ];  
				
		return $this->withHeaders($headers)->json('put', '/api/products/1', $product)
			->assertStatus(400)
			->assertJson($expected_response);
	}
	
	/** @test */
    public function test_product_deleted_successfully() {
		ProductCategory::factory()->create();
		Brand::factory()->create();
		Product::factory()->create([
			'title' => 'Часы Certina',
			'price' => 35.5,
			'product_category_id' => 1,
			'brand_id' => 1,
		]);
		
		Role::create([ 'name' => 'Администратор' ]);
		$user = User::create([
			'role_id' => 1,
			'name' => 'Иванов Иван',
			'email' => 'test@email.ru',
			'password' => Hash::make('password'),
		]);
		$token = $user->createToken('access_token')->plainTextToken;
		
		$headers = [
			'Accept' => 'application/json',
			'Authorization' => "Bearer $token"
		];
			
		$expected_response = [
            'success' => true,
            'message' => 'Product deleted successfully',
            'data'    => []
        ];  
				
		return $this->withHeaders($headers)->json('delete', '/api/products/1')
			->assertStatus(200)
			->assertJson($expected_response);
	}
}
