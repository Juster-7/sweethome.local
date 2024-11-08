<?php

namespace App\Orchid\Screens\Post;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Color;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Toast;
use App\Http\Requests\PostCategoryCreateRequest;

class PostCategoryEditScreen extends Screen
{
	public $postCategory;

    public function save(PostCategoryCreateRequest $request, PostCategory $postCategory) {
		$postCategory->fill($request->validated())->save();
		Toast::info('Категория "'.$postCategory->title.'" отредактирована.');

        return redirect()->route('platform.posts.categories');
	}

	public function back() {
        return redirect()->route('platform.posts.categories');
	}	

    public function query(PostCategory $postCategory): iterable {
		return [
            'postCategory' => $postCategory
        ];
    }

    public function name(): ?string {
        return 'Редактирование категории';
    }

    public function commandBar(): iterable {
        return [];
    }

    public function layout(): iterable {
        return [
			Layout::rows([
                Input::make('title')
                    ->title('Категория')
                    ->type('text')
                    ->value($this->postCategory->title)
                    ->horizontal(),

                Input::make('slug')
                    ->title('Slug')
                    ->type('text')
                    ->value($this->postCategory->slug)
                    ->horizontal()
					->disabled(),

                Input::make('css_color')
                    ->type('color')
                    ->title('Цвет')
                    ->value($this->postCategory->css_color)
                    ->horizontal(),
						
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
				])->autoWidth(),
            ]),
		];
    }
}
