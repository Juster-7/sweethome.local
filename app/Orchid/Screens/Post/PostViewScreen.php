<?php

namespace App\Orchid\Screens\Post;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Screen;
use Orchid\Screen\Sight;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Color;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\User;
use Orchid\Support\Facades\Toast;

class PostViewScreen extends Screen
{
	public $post;


	public function back() {
        return redirect()->route('platform.posts');
	}	

	public function edit(Post $post) {
        return redirect()->route('platform.posts.edit', $post->id);
	}
	
	public function comments(Post $post) {
        return redirect()->route('platform.posts.edit', $post->id);
	}
	
    public function query(Post $post): iterable {
		return [
            'post' => $post
        ];
    }

    public function name(): ?string {
        return 'Просмотр статьи';
    }

    public function commandBar(): iterable {
        return [
			Button::make('Назад')                    
				->icon('arrow-left-circle')
				->align(TD::ALIGN_CENTER)
				->type(Color::DEFAULT())
				->method('back'),
			Button::make(__('Edit'))
				->icon('pencil')
				->align(TD::ALIGN_CENTER)
				->type(Color::DEFAULT())
				->method('edit', [$this->post]),
			Button::make('Комментарии')
				->icon('bubbles')
				->align(TD::ALIGN_CENTER)
				->type(Color::DEFAULT())
				->method('comments', [$this->post])
		];
    }

    public function layout(): iterable {
        return [
			Layout::view('orchid-post-view'),
		];
    }
}
