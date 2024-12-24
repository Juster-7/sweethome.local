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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('product_category_id');
			$table->foreign('product_category_id')->references('id')->on('product_categories')->onDelete('cascade');
			$table->unsignedBigInteger('product_brand_id');
			$table->foreign('product_brand_id')->references('id')->on('product_brands')->onDelete('cascade');
            $table->string('title', 255);
            $table->string('slug', 255)->unique();
			$table->text('intro_text')->nullable();
			$table->text('main_text')->nullable();
			$table->string('image', 50)->nullable();
			$table->decimal('price', 10, 2)->default(0);
			$table->integer('quantity')->default(0);
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
        Schema::dropIfExists('products');
    }
};
