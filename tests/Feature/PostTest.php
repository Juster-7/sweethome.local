<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use App\Models\Post;
use App\Models\PostCategory;
use App\Repositories\PostRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PostsTest extends TestCase
{
	use DatabaseMigrations;
    
	/** @test */
    public function test_user_can_browse_posts_successfully() {
		$user = $this->createUser();
		$postCategory = PostCategory::factory()->create();

		$post = Post::factory()
			->for($postCategory)
			->for($user)
			->create();
        
		$this->get('/posts')->assertSee($post->title);
    }
	 
	/** @test */
    public function test_function_gettopposts_works_successfully() {
		$user = $this->createUser();
		$postCategory = PostCategory::factory()->create();
		
		Post::factory()
			->for($postCategory)
			->for($user)
			->count(50)
			->create();
		$topViewedPost = Post::factory()
			->for($postCategory)
			->for($user)
			->create([ 'hits' => 1000000 ]);

        $postRepository = new PostRepository;
        $post = $postRepository->getTopPosts(1);
		
        $this->assertEquals($topViewedPost->id, $post->first()->id);
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
}
