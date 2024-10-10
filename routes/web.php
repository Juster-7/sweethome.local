<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;

/* 
 * Главная 
 */
Route::get('/', [IndexController::class, 'index'])->name('index');

/*
 * Статьи 
 */
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::any('/posts/category', function() { return redirect('/posts'); });
Route::any('/posts/category/{postCategory:slug}', [PostController::class, 'postCategory'])->name('posts.postCategory');
Route::any('/posts/post', function() { return redirect('/posts'); });
Route::any('/posts/post/{post:slug}', [PostController::class, 'post'])->name('posts.post');
Route::any('/posts/post/{post:slug}#comments', [PostController::class, 'post'])->name('posts.post.comments');
Route::any('/posts/post/{post:slug}#add_comment', [PostController::class, 'post'])->name('posts.post.add_comment');

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
Route::any('/shop/category', function() { return redirect('/shop'); });
Route::get('/shop/category/{productCategory:slug}', [ShopController::class, 'productCategory'])->name('shop.productCategory');
Route::any('/shop/brand', function() { return redirect('/shop'); });
Route::get('/shop/brand/{brand:slug}', [ShopController::class, 'brand'])->name('shop.brand');
Route::any('/shop/product', function() { return redirect('/shop'); });
Route::get('/shop/product/{product:slug}', [ShopController::class, 'product'])->name('shop.product');

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

/* 
 * Личный кабинет пользователя. Регистрация, вход, восстановление пароля 
 */	
Route::name('user.')->prefix('user')->group(function () {
	Auth::routes();
	Route::any('/', function() { return redirect('user/main'); });
	Route::get('main', [UserController::class, 'index'])->name('index');
});
