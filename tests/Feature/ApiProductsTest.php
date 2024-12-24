<?php

namespace Tests\Feature;

use App\Http\Resources\ProductResource;
use App\Models\Role;
use App\Models\User;
use App\Models\ProductBrand;
use App\Models\ProductCategory;
use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ApiProductsTest extends TestCase
{
	use DatabaseMigrations;

	protected $headers;
	protected $productCategory;
	protected $brand;

	protected function setUp():void {
		parent::setUp();

		$this->headers = $this->makeHeadersWithUserToken();
		$this->productCategory = ProductCategory::factory()->create();
		$this->brand = ProductBrand::factory()->create();
	}

	public function makeHeadersWithUserToken() {
		$user = $this->createUser();
		$token = $this->createUserToken($user);

		return [
			'Accept' => 'application/json',
			'Authorization' => "Bearer $token"
		];
	}

	public function createUser() {
		return User::factory()
			->for(Role::factory()->create())
			->create([
				'name' => 'Иванов Иван',
				'email' => 'test@email.ru',
				'password' => Hash::make('password'),
			]);
	}

	public function createUserToken($user) {
		return $user->createToken('access_token')->plainTextToken;
	}

	public function createProduct() {
		Product::factory()
			->for($this->productCategory)
			->for($this->brand)
			->create([
				'title' => 'Часы Certina',
				'price' => 35.5,
			]);
	}

	public function createSecondProduct() {
		Product::factory()
			->for($this->productCategory)
			->for($this->brand)
			->create([
				'title' => 'Часы Rolex',
				'price' => 75,
			]);
	}

	/** @test */
    public function test_product_created_successfully() {
		$product = [
			'title' => 'Часы Certina',
			'price' => 35.5,
			'product_category_id' => $this->productCategory->id,
			'brand_id' => $this->brand->id,
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

		return $this->withHeaders($this->headers)->json('post', '/api/products', $product)
			->assertStatus(201)
			->assertJson($expected_response);
    }

	/** @test */
    public function test_products_retrieved_successfully() {
		$this->createProduct();
		$this->createSecondProduct();

		$expected_response = [
            'success' => true,
            'message' => 'Products retrieved successfully',
            'data'    => [
				[ 'created_at' => Date('d/m/Y'), 'id' => 1, 'price' => 35.5, 'title' => 'Часы Certina', 'updated_at' => Date('d/m/Y') ],
				[ 'created_at' => Date('d/m/Y'), 'id' => 2, 'price' => 75, 'title' => 'Часы Rolex', 'updated_at' => Date('d/m/Y') ]
			]
        ];

		return $this->withHeaders($this->headers)->json('get', '/api/products')
			->assertStatus(200)
			->assertJson($expected_response)
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
    public function test_product_create_without_title_validated() {
		$product = [
			'title' => '',
			'price' => 35.5,
			'product_category_id' => $this->productCategory->id,
			'brand_id' => $this->brand->id,
		];

		$expected_response = [
            'success' => false,
            'message' => 'Validation Error',
            'data'    => [
				'title' => [ 'Поле Наименование обязательно для заполнения.' ]
			]
        ];

		return $this->withHeaders($this->headers)->json('post', '/api/products', $product)
			->assertStatus(400)
			->assertJson($expected_response);
    }

	/** @test */
    public function test_product_retrieved_successfully() {
		$this->createProduct();

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

		return $this->withHeaders($this->headers)->json('get', '/api/products/1')
			->assertStatus(200)
			->assertJson($expected_response);
	}

	/** @test */
    public function test_product_not_found() {
		$expected_response = [
            'success' => false,
            'message' => 'Product not found'
        ];

		return $this->withHeaders($this->headers)->json('get', '/api/products/1')
			->assertStatus(404)
			->assertJson($expected_response);
	}

	/** @test */
    public function test_product_updated_successfully() {
		$this->createProduct();

		$product = [
			'title' => 'Часы Longines'
		];

		$expected_response = [
            'success' => true,
            'message' => 'Product updated successfully',
            'data'    => [
				'id' => 1,
				'title' => 'Часы Longines',
				'price' => 35.5,
				'created_at' => Date('d/m/Y'),
				'updated_at' => Date('d/m/Y')
			]
        ];

		return $this->withHeaders($this->headers)->json('put', '/api/products/1', $product)
			->assertStatus(200)
			->assertJson($expected_response);
	}

	/** @test */
    public function test_product_update_without_title_validated() {
		$this->createProduct();

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

		return $this->withHeaders($this->headers)->json('put', '/api/products/1', $product)
			->assertStatus(400)
			->assertJson($expected_response);
	}

	/** @test */
    public function test_product_deleted_successfully() {
		$this->createProduct();

		$expected_response = [
            'success' => true,
            'message' => 'Product deleted successfully',
            'data'    => []
        ];

		return $this->withHeaders($this->headers)->json('delete', '/api/products/1')
			->assertStatus(200)
			->assertJson($expected_response);
	}
}
