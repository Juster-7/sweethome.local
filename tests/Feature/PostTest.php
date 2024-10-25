<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class PostsTest extends TestCase
{
	use DatabaseMigrations;
    
	/** @test */
    public function test_user_can_browse_posts_successfully() {
		Role::factory()->create();
		User::create([
			'role_id' => 1,
			'name' => 'Иванов Иван',
			'email' => 'test@email.ru',
			'password' => 'password',
		]);
		PostCategory::factory()->create();
		$post = Post::factory()->create([
			'post_category_id' => 1,
			'user_id' => 1,
		]);
        
		$this->get('/posts')->assertSee($post->title);
    }
	 
	/** @test */
    public function test_function_gettopposts_works_successfully() {
		Role::factory()->create();
		User::create([
			'role_id' => 1,
			'name' => 'Иванов Иван',
			'email' => 'test@email.ru',
			'password' => 'password',
		]);
		PostCategory::factory()->create();
		Post::factory()->count(50)->create([
			'post_category_id' => 1,
			'user_id' => 1,
		]);
		$topViewedPost = Post::factory()->create([
			'post_category_id' => 1,
			'user_id' => 1,
			'hits' => 1000000
		]);
        $post = new Post;
		$post = $post->getTopPosts(1);
		
        $this->assertEquals($topViewedPost->id, $post->first()->id);
    }
}
