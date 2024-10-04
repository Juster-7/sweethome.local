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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('post_id');
			$table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
			$table->integer('parent_id')->nullable();
			$table->string('name', 255);
			$table->string('email', 255);
			$table->text('text');
			$table->string('access_token', 32);
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
        Schema::dropIfExists('comments');
    }
};
