<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
			$table->string('title', 255);
			$table->string('slug', 255)->unique();
			$table->string('author', 255);			
			$table->string('image_name', 255);			
			$table->string('theme', 255);			
			$table->text('intro_text');
			$table->text('main_text');
			$table->string('meta_description', 255);
			$table->string('meta_keyword', 255);
			$table->integer('hits');
			$table->dateTime('date_show');
			$table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
