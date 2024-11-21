<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Color;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * @return Menu[]
     */
    public function registerMainMenu(): array
    {
        return [
			Menu::make('Статьи')
                ->title('Блог')
				->icon('book-open')
                ->list([
                    Menu::make('Статьи')
						->icon('docs')
						->route('platform.posts'),
                    Menu::make('Категории')
						->icon('directions')
						->route('platform.posts.categories'),
                ]),	
			Menu::make('Комментарии')
                ->icon('bubbles')
                ->route('platform.systems.users'),	
			Menu::make('Авторы')
                ->icon('user')
                ->route('platform.systems.users'),
			Menu::make('Аналитика')
                ->icon('bar-chart')
                ->route('platform.systems.users')
				->divider(),
            
			Menu::make('Товары')
                ->title('Магазин')
				->icon('bag')
                ->list([
                    Menu::make('Товары')
						->icon('handbag')
						->route('platform.systems.users'),
                    Menu::make('Категории')
						->icon('tag')
						->route('platform.systems.users'),
					Menu::make('Бренды')
						->icon('badge')
						->route('platform.systems.users'),
                ]),	
			Menu::make('Заказы')
                ->icon('docs')
                ->route('platform.systems.users'),	
			Menu::make('Покупатели')
                ->icon('user')
                ->route('platform.systems.users'),
			Menu::make('Аналитика')
                ->icon('pie-chart')
                ->route('platform.systems.users')
				->divider(),
            
			Menu::make(__('Users'))
                ->icon('user')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title(__('Access rights')),

            Menu::make(__('Roles'))
                ->icon('lock')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles')
				->divider(),
				
			Menu::make('Статистика')
                ->title('Статистика доступа')
				->icon('bar-chart')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->divider(),	
			
			/*
			
			Menu::make('Example screen')
                ->icon('monitor')
                ->route('platform.example')
                ->title('Navigation')
                ->badge(fn () => 6),

            Menu::make('Dropdown menu')
                ->icon('code')
                ->list([
                    Menu::make('Sub element item 1')
						->icon('bag'),
                    Menu::make('Sub element item 2')
						->icon('heart'),
                ]),

            Menu::make('Basic Elements')
                ->title('Form controls')
                ->icon('note')
                ->route('platform.example.fields'),

            Menu::make('Advanced Elements')
                ->icon('briefcase')
                ->route('platform.example.advanced'),

            Menu::make('Text Editors')
                ->icon('list')
                ->route('platform.example.editors'),

            Menu::make('Overview layouts')
                ->title('Layouts')
                ->icon('layers')
                ->route('platform.example.layouts'),

            Menu::make('Chart tools')
                ->icon('bar-chart')
                ->route('platform.example.charts'),

            Menu::make('Cards')
                ->icon('grid')
                ->route('platform.example.cards')
                ->divider(),

            Menu::make('Documentation')
                ->title('Docs')
                ->icon('docs')
                ->url('https://orchid.software/en/docs'),

            Menu::make('Changelog')
                ->icon('shuffle')
                ->url('https://github.com/orchidsoftware/platform/blob/master/CHANGELOG.md')
                ->target('_blank')
                ->badge(fn () => Dashboard::version(), Color::DARK()),
			*/
        ];
    }

    /**
     * @return Menu[]
     */
    public function registerProfileMenu(): array
    {
        return [
            Menu::make(__('Profile'))
                ->route('platform.profile')
                ->icon('user'),
        ];
    }

    /**
     * @return ItemPermission[]
     */
    public function registerPermissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users')),
        ];
    }
}
