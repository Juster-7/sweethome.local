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
use Orchid\Screen\TD;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Color;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Toast;
use App\Http\Requests\PostCreateRequest;

class PostEditScreen extends Screen
{
	public $post;

    public function save(PostCreateRequest $request, Post $post) {
		$post->fill($request->validated())->save();
		Toast::info('Статья "'.$post->title.'" отредактирована.');

        return redirect()->route('platform.posts');
	}

	public function back() {
        return redirect()->route('platform.posts');
	}	

    public function query(Post $post): iterable {
		return [
            'post' => $post
        ];
    }

    public function name(): ?string {
        return 'Редактирование статьи';
    }

    public function commandBar(): iterable {
        return [
			Button::make('Назад')                    
				->icon('arrow-left-circle')
				->align(TD::ALIGN_CENTER)
				->type(Color::DEFAULT())
				->method('back'),
			Button::make(__('Save'))                    
				->icon('check')
				->align(TD::ALIGN_CENTER)
				->type(Color::DEFAULT())
				->method('save')
		];
    }

    public function layout(): iterable {
        return [
			Layout::rows([
				Group::make([
					Input::make('meta_description')
						->title('SEO: description')
						->value($this->post->meta_description)
						->type('text'),
					Input::make('meta_keyword')
						->title('SEO: keywords')
						->value($this->post->meta_keyword)
						->type('text'),
				]),
			]),
			Layout::rows([
				Group::make([
					Select::make('user_id')
						->empty('', 0)
						->value($this->post->user_id)
						->fromModel(User::orderBy('name'), 'name', 'id')
						//Relation: ->displayAppend('idName')
						->title('Автор'),	
					Select::make('post_category_id')
						->empty('', 0)
						->value($this->post->post_category_id)
						->fromModel(PostCategory::orderBy('title'), 'title', 'id')
						->title('Категория'),	
					DateTimer::make('date_show')
                        ->title('Дата показа')
                        ->value($this->post->date_show)
						->enableTime()
						->format24hr()
						->format('d.m.Y H:i')
						->placeholder(''),
				]),
			]),
			Layout::rows([	
				Group::make([
					Input::make('title')
						->title('Название статьи')
						->value($this->post->title)
						->type('text'),			
					Input::make('slug')
						->title('Slug')
						->value($this->post->slug)
						->type('text')
						->disabled()
				]),
				Input::make('intro_text')
					->title('Вводный текст')
					->value($this->post->intro_text)
						->type('text'),
				Quill::make('main_text')
					->title('Текст статьи')
					->value($this->post->main_text),
				Group::make([
					Button::make('Назад')                    
						->icon('arrow-left-circle')
						->align(TD::ALIGN_CENTER)
						->type(Color::DEFAULT())
						->method('back'),
					Button::make(__('Save'))                    
						->icon('check')
						->align(TD::ALIGN_CENTER)
						->type(Color::DEFAULT())
						->method('save')
				])->autoWidth()
			])
		];
    }
}
