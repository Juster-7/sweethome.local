<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Storage;

class ClearStorageAndMigrateFreshSeed extends Command
{
    protected $signature = 'csmfs';
	protected $description = 'Clear Storage then Migrate:Fresh and Seed';

    public function handle()
    {
		$time_start = microtime(true);
		$this->info('Удаление аватарок в Storage::disk(\'profile-photos\')...');
        $this->clearStorage();
		$this->info('');
		$this->info('Запуск php artisan migrate:fresh...');
		$this->call('migrate:fresh');
		$this->info('Запуск php artisan db:seed...');
		$this->call('db:seed');		
		$this->info('Создание учетной записи администратора для Orchid...');
		$this->info('Запуск php artisan orchid:admin Администратор w@w.w 22222222');
		$this->callSilently('orchid:admin', ['name' => 'Администратор', 'email' => 'w@w.w', 'password' => '22222222']);
		$this->info('Учетная запись успешно создана.');
		$this->info('');	
		$time_end = microtime(true);
		$this->info('Данные сайта обновлены: '.number_format($time_end - $time_start, 2).' секунд.');
        
		return Command::SUCCESS;
    }
	
	private function clearStorage() {
		$storage = Storage::disk('profile-photos');
		$this->info('Найдено файлов: '.count($storage->files('')));
		$bar = $this->output->createProgressBar(count($storage->files('')));
		$this->info('Удаляю файлы... ');
		$bar->start();
		$count_deleted = 0;
		foreach ($storage->files('') as $file) {
			$storage->delete($file);
			$count_deleted++;
			$bar->advance();
		}
		$this->newLine();
		$bar->finish();
		$this->info('Удалено файлов: '.$count_deleted);		
	}
}
