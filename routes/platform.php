<?php

declare(strict_types=1);
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use App\Orchid\Screens\Post\PostListScreen;
use App\Orchid\Screens\Post\PostViewScreen;
use App\Orchid\Screens\Post\PostEditScreen;
use App\Orchid\Screens\Post\PostCategoryListScreen;
use App\Orchid\Screens\Post\PostCategoryEditScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');

// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Profile'), route('platform.profile')));

// Platform > System > Users > User
Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit')
    ->breadcrumbs(fn (Trail $trail, $user) => $trail
        ->parent('platform.systems.users')
        ->push($user->name, route('platform.systems.users.edit', $user)));

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.users')
        ->push(__('Create'), route('platform.systems.users.create')));

// Platform > System > Users
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Users'), route('platform.systems.users')));

// Platform > System > Roles > Role
Route::screen('roles/{role}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(fn (Trail $trail, $role) => $trail
        ->parent('platform.systems.roles')
        ->push($role->name, route('platform.systems.roles.edit', $role)));

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.roles')
        ->push(__('Create'), route('platform.systems.roles.create')));

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Roles'), route('platform.systems.roles')));

// Posts
Route::screen('posts', PostListScreen::class)
    ->name('platform.posts')
    ->breadcrumbs(fn (Trail $trail) => $trail
		->parent('platform.index')
        ->push('Cтатьи', route('platform.posts')));

// Posts > View
Route::screen('posts/{post}/view', PostViewScreen::class)
    ->name('platform.posts.view')
    ->breadcrumbs(fn (Trail $trail, $post) => $trail
        ->parent('platform.posts')
		->push($post->title));

// Posts > Edit
Route::screen('posts/{post}/edit', PostEditScreen::class)
    ->name('platform.posts.edit')
    ->breadcrumbs(fn (Trail $trail, $post) => $trail
        ->parent('platform.posts')
		->push($post->title));
		
// Posts > Categories
Route::screen('posts/categories', PostCategoryListScreen::class)
    ->name('platform.posts.categories')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.posts')
		->push('Категории', route('platform.posts.categories')));

// Posts > Categories > Edit
Route::screen('posts/categories/{postCategory}/edit', PostCategoryEditScreen::class)
    ->name('platform.posts.category.edit')
    ->breadcrumbs(fn (Trail $trail, $postCategory) => $trail
        ->parent('platform.posts.categories')
		->push($postCategory->title));
