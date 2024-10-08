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
        Schema::create('cart_product', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('cart_id')->unsigned()->nullable();
            $table->bigInteger('product_id')->unsigned()->nullable();
			$table->integer('quantity')->unsigned()->nullable();
            $table->timestamps();
			
			$table->foreign('cart_id')
				->references('id')
				->on('carts')
				->cascadeOnDelete();
			$table->foreign('product_id')
				->references('id')
				->on('products')
				->cascadeOnDelete();
		});	
	}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_product');
    }
};
