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
			$table->string('meta_description', 255);
			$table->string('meta_keyword', 255);
			$table->string('title', 255);
			$table->string('slug', 255)->unique();
			$table->string('title_image', 255);	
			$table->text('intro_text');
			$table->text('main_text');
			$table->integer('hits');
			$table->dateTime('date_show');
			$table->unsignedBigInteger('user_id');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->unsignedBigInteger('post_category_id');
			$table->foreign('post_category_id')->references('id')->on('post_categories')->onDelete('cascade');
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
