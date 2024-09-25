<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SearchController;

/* 
 * Главная 
 */
Route::get('/', [IndexController::class, 'index'])->name('index');

/*
 * Статьи 
 */
Route::get('/posts', [PostController::class, 'posts'])->name('posts');
Route::any('/posts/{slug}', [PostController::class, 'post'])->name('post');
Route::any('/posts/{slug}#comments', [PostController::class, 'post'])->name('post.comments');
Route::any('/posts/{slug}#add_comment', [PostController::class, 'post'])->name('post.add_comment');

/*
 * Комментарии 
 */
Route::get('/comments/{comment}/delete', [CommentController::class, 'delete'])->name('comment.delete')->middleware('can:delete,comment');
Route::any('/comments/add', [CommentController::class, 'store'])->name('comment.add');

/* 
 * Статические страницы 
 */
Route::get('/contacts', [PageController::class, 'contacts'])->name('contacts');
Route::get('/about', [PageController::class, 'about'])->name('about');

/* 
 * Магазин 
 */
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/category/{slug}', [ShopController::class, 'category'])->name('shop.category');
Route::get('/shop/brand/{slug}', [ShopController::class, 'brand'])->name('shop.brand');
Route::get('/shop/product/{slug}', [ShopController::class, 'product'])->name('shop.product');

/*
 * Корзина 
 */
Route::group([
	'as' => 'cart.',
	'prefix' => 'cart'
], function (){
	Route::get('/', [CartController::class, 'index'])->name('index');
	Route::get('checkout', [CartController::class, 'checkout'])->name('checkout');
	Route::post('add/{id}', [CartController::class, 'add'])->where('id', '[0-9]+')->name('add');
	Route::post('increase/{product_id}', [CartController::class, 'increase'])->where('product_id', '[0-9]+')->name('increase');
	Route::post('decrease/{product_id}', [CartController::class, 'decrease'])->where('product_id', '[0-9]+')->name('decrease');
	Route::post('remove/{product_id}', [CartController::class, 'remove'])->where('product_id', '[0-9]+')->name('remove');
});



/* 
 * Поиск 
 */	
Route::get('/search', [SearchController::class, 'search'])->name('search');
