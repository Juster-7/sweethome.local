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

/** Главная */
Route::get('/', [IndexController::class, 'index'])->name('index');

/** Статьи */
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::any('/posts/category', function() { return redirect('/posts'); });
Route::any('/posts/category/{postCategory:slug}', [PostController::class, 'postCategory'])->name('posts.postCategory');
Route::any('/posts/post', function() { return redirect('/posts'); });
Route::any('/posts/post/{post:slug}', [PostController::class, 'post'])->name('posts.post');

/** Комментарии */
Route::get('/comments/{comment}/delete', [CommentController::class, 'delete'])->name('comment.delete')->can('delete', 'comment');
Route::any('/comments/add', [CommentController::class, 'store'])->name('comment.add');

/** Статические страницы */
Route::get('/contacts', [PageController::class, 'contacts'])->name('contacts');
Route::get('/about', [PageController::class, 'about'])->name('about');

/** Магазин */
Route::group([
	'as' => 'shop.',
	'prefix' => 'shop'
], function (){
	Route::get('/', [ShopController::class, 'index'])->name('index');
	Route::any('category', function() { return redirect('/shop'); });
	Route::get('category/{productCategory:slug}', [ShopController::class, 'productCategory'])->name('productCategory');
	Route::any('brand', function() { return redirect('/shop'); });
	Route::get('brand/{brand:slug}', [ShopController::class, 'brand'])->name('brand');
	Route::any('product', function() { return redirect('/shop'); });
	Route::get('product/{product:slug}', [ShopController::class, 'product'])->name('product');
});

/** Корзина */
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

/** Поиск */	
Route::get('/search', [SearchController::class, 'search'])->name('search');

/** Личный кабинет пользователя. Регистрация, вход, восстановление пароля */	
Route::group([
	'as' => 'user.',
	'prefix' => 'user'
], function (){
		Auth::routes();
		Route::any('/', function() { return redirect('user/main'); });
		Route::get('main', [UserController::class, 'index'])->name('index');
		Route::get('profile', [UserController::class, 'profileIndex'])->name('profile');
		Route::post('profile', [UserController::class, 'profilePhotoStore'])->name('profile.photo.store');
		Route::post('profile/photo/delete', [UserController::class, 'profilePhotoDelete'])->name('profile.photo.delete');
});
