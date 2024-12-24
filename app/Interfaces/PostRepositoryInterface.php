<?php

namespace App\Interfaces;

interface PostRepositoryInterface {
	public function getPosts();
	public function getLastPosts(int $count);
	public function getTopPosts(int $count);
}
