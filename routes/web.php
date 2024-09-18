<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [MainController::class, 'index'])->name('index');
Route::get('/articles', [MainController::class, 'articles'])->name('articles');
Route::any('/articles/{alias}', [MainController::class, 'article'])->name('article');
Route::any('/articles/{alias}#comments', [MainController::class, 'article'])->name('article.comments');
Route::any('/articles/{alias}#add_comment', [MainController::class, 'article'])->name('article.add_comment');
Route::get('/contacts', [MainController::class, 'contacts'])->name('contacts');
Route::get('/about', [MainController::class, 'about'])->name('about');
Route::get('/shop', [MainController::class, 'shop'])->name('shop');

Route::get('/comments/{comment}/delete', [MainController::class, 'deleteComment'])->name('comment.delete')
	->middleware('can:delete,comment');
	
Route::get('/search', [MainController::class, 'search'])->name('search');
