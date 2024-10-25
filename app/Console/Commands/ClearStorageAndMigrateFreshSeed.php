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
		$time_end = microtime(true);
		$this->info('Данные сайта обновлены: '.number_format($time_end - $time_start, 2).' секунд.');
        
		return Command::SUCCESS;
    }
	
	private function clearStorage() {
		$storage = Storage::disk('profile-photos');
		$this->info('Найдено файлов: '.count($storage->files('')));
		$this->info('Удаляю файлы...');
		$count_deleted = 0;
		foreach ($storage->files('') as $file) {
			if($file!='N7sTnTGzaBJoiZP2yNwsB3U578iULuNGxxGNzh3q.jpg'){
				$storage->delete($file);
				$count_deleted++;
			}
		}
		$this->info('Удалено файлов: '.$count_deleted);		
	}
}
