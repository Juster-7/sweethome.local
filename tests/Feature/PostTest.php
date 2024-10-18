<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;


class PostsTest extends TestCase
{
	use DatabaseMigrations;
    
	/** @test */
    public function test_user_can_browse_posts() {
		PostCategory::factory()->create();
		$post = Post::factory()->create(['post_category_id' => 1]);
        
		$this->get('/posts')->assertSee($post->title);
    }
	
	/**
     * Test Driven Dev
     *
     * @return void
     */
	 
	/** @test */
    public function test_function_gettopposts_works() {
		PostCategory::factory()->count(10)->create();
		Post::factory()->count(50)->create();
		$topViewedPost = Post::factory()->create(['hits' => 1000000]);
        $post = new Post;
		$post = $post->getTopPosts(1);
		
        $this->assertEquals($topViewedPost->id, $post->first()->id);
    }
}
