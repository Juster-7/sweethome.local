<?php

namespace App\Orchid\Screens\Post;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Layouts\Modal;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\PostCreateRequest;

class PostListScreen extends Screen
{
	public function create(PostCreateRequest $request, Post $post) {
		$post->fill($request->validated())->save();
	}

	public function delete(Post $post) {
		$post->delete();
		Toast::info('Статья "'.$post->title.'" удалена.');
	}	
	
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Request $request, Post $post): iterable
    {
		$posts = $post->with('postCategory')->where('date_show', '<', now())
				->filters()
				->paginate(20);
		$postsCount = $post->where('date_show', '<', now())
				->count();
        $postsCountLastMonth = $post->where('date_show', '<', now())
			->where('created_at', '>=', now()->subMonth(1))
				->count();
		return [
			'posts' => $posts,
			'metrics' => [
                'postsCount'    => ['value' => number_format($postsCount), 'diff' => 100],
                'postsCountLastMonth'    => ['value' => number_format($postsCountLastMonth), 'diff' => round($postsCountLastMonth*100/$postsCount,1)],
                //'authorsCount' => ['value' => number_format(24668), 'diff' => -30.76],
                //'authorsCountLastMonth' => ['value' => number_format(24668), 'diff' => -30.76],
                //'orders'   => ['value' => number_format(10000), 'diff' => 0],
                //'total'    => number_format(65661),
            ],
		];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Статьи';
    }

	/*
	public function description(): ?string
    {
        return 'Статьи на сайте';
    }
	*/
	
    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
			ModalToggle::make('Добавить статью')
				->modal('postModal')
				->method('create')
				->icon('plus'),
		];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
			Layout::metrics([
                'Всего статей'    => 'metrics.postsCount',
                'Статей за прошлый месяц'    => 'metrics.postsCountLastMonth',
                //'Всего авторов' => 'metrics.authorsCount',
                //'Новых авторов за прошлый месяц' => 'metrics.authorsCountLastMonth',
                //'Pending Orders' => 'metrics.orders',
                //'Total Earnings' => 'metrics.total',
            ]),
			Layout::table('posts', [
				TD::make('id', 'ID')
					->width('50px')
					->sort(),
				TD::make('title', 'Заголовок')
					->render(function (Post $post) {
						return Link::make($post->title)
								->route('platform.posts.view', $post->id);
					})
					->width('50%')
					->sort(),
				TD::make('postCategory', 'Категория')
					->render(function ($post) {
						return '<p style="text-align:center;padding:5px;background-color:'.$post->postCategory->css_color.'">'.$post->postCategory->title.'</p>';
					})
					->width('80px')
					->align(TD::ALIGN_CENTER),
				TD::make('hits', 'Просмотры')
					->render(function (Post $post) {
						if($post->hits>500) 
							return '<b>'.$post->hits.'</b>';
						else
							return $post->hits;
					})
					->width('80px')
					->align(TD::ALIGN_CENTER)
					->sort(),
				TD::make('created_at', 'Дата создания')
					->render(function (Post $post) {
						return $post->created_at->format('d.m.Y');
					})
					->width('120px')
					->align(TD::ALIGN_CENTER)
					->sort(),
				TD::make(__('Actions'))
                ->render(fn (Post $post) => DropDown::make()
                    ->icon('options-vertical')
                    ->list([
                        Link::make('Просмотр')
                            ->route('platform.posts.view', $post->id)
                            ->icon('eye'),
                        Link::make(__('Edit'))
                            ->route('platform.posts.edit', $post->id)
                            ->icon('pencil'),
						Link::make('Комментарии')
                            ->route('platform.posts.edit', $post->id)
                            ->icon('bubbles'),
                        Button::make(__('Delete'))
                            ->icon('trash')
                            ->confirm('Действительно удалить статью "'.$post->title.'"?')
							->method('delete', ['post' => $post->id]),
                    ]))
				->width('50px')
				->align(TD::ALIGN_CENTER),	
			]),
		
			Layout::modal('postModal', Layout::rows([
				Group::make([
					Input::make('meta_description')
						->title('SEO: description')
						->type('text'),
					Input::make('meta_keyword')
						->title('SEO: keywords')
						->type('text'),
				]),
				Group::make([
					Select::make('user_id')
						->empty('', 0)
						->fromModel(User::orderBy('name'), 'name', 'id')
						//Relation: ->displayAppend('idName')
						->title('Автор'),	
					Select::make('post_category_id')
						->empty('', 0)
						->fromModel(PostCategory::orderBy('title'), 'title', 'id')
						->title('Категория'),	
					DateTimer::make('date_show')
                        ->title('Дата показа')
                        ->enableTime()
						->format24hr()
						->format('d.m.Y H:i')
						->placeholder(''),
				]),
				Input::make('title')
					->title('Название статьи')
					->type('text'),			
				Input::make('intro_text')
					->title('Вводный текст')
					->type('text'),
				Quill::make('main_text')
					->title('Текст статьи'),
			]))
				->size(Modal::SIZE_LG)
				->title('Добавление статьи')
				->applyButton('Добавить'),
		];
    }
}
