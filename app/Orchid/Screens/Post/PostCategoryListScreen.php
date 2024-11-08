<?php

namespace App\Orchid\Screens\Post;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use App\Models\PostCategory;
use App\Http\Requests\PostCategoryCreateRequest;
use Illuminate\Http\Request;

class PostCategoryListScreen extends Screen
{
	public function create(PostCategoryCreateRequest $request, PostCategory $postCategory) {
		$postCategory->fill($request->validated())->save();
	}

	public function delete(PostCategory $postCategory) {
		$postCategory->delete();
		Toast::info('Категория "'.$postCategory->title.'" удалена.');
	}	

    public function query(Request $request, PostCategory $postCategory): iterable
    {
		$postCategories = $postCategory
				->filters()
				->take(20)
				->paginate();
		return [
			'postCategories' => $postCategories
		];
    }

    public function name(): ?string
    {
        return 'Категории';
    }

    public function commandBar(): iterable
    {
        return [
			ModalToggle::make('Добавить категорию')
				->modal('postModal')
				->method('create')
				->icon('plus'),
		];
    }

    public function layout(): iterable
    {
        return [
			Layout::table('postCategories', [
				TD::make('id', 'ID')
					->width('60px')
					->sort(),
				TD::make('title', 'Категория')
					->render(function (PostCategory $postCategory) {
						return Link::make($postCategory->title)
								->route('platform.posts.category.edit', $postCategory->id);
					})
					->sort(),
				TD::make('slug', 'Slug')->sort(),
				TD::make('css_color', 'Цвет')
					->render(function (PostCategory $postCategory) {
						return '<div style="height:20px;width:60px;background-color:'.$postCategory->css_color.'"></div>';
					})
					->width('120px')
					->align(TD::ALIGN_CENTER)
					->sort(),
				TD::make('created_at', 'Дата создания')->sort()
					->render(function (PostCategory $postCategory) {
						return $postCategory->created_at->format('d.m.Y');
					})
					->width('120px')
					->align(TD::ALIGN_CENTER)
					->sort(),
				TD::make(__('Actions'))
					->render(fn (PostCategory $postCategory) => DropDown::make()
						->icon('options-vertical')
						->list([
							Link::make(__('Edit'))
								->route('platform.posts.category.edit', $postCategory->id)
								->icon('pencil'),
							Button::make(__('Delete'))
								->icon('trash')
								->confirm('Действительно удалить категорию "'.$postCategory->title.'"?')
								->method('delete', ['postCategory' => $postCategory->id]),
						]))
					->align(TD::ALIGN_CENTER)
					->width('50px'),	
			]),
			
			Layout::modal('postModal', Layout::rows([
				Input::make('title')
					->title('Название категории')
					->placeholder('Введите название...'),
				Input::make('css_color')
                    ->type('color')
                    ->title('Цвет'),				
			]))
				->title('Добавление категории')
				->applyButton('Добавить'),
		];
    }
}
