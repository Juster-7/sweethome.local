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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();			
            $table->decimal('duration')->nullable();
            $table->integer('user_id')->nullable();
            $table->ipAddress('ip')->nullable();
            $table->string('url')->nullable();
            $table->string('method')->nullable();
            $table->string('input')->nullable();
            $table->string('agent')->nullable();
			$table->timestamp('created_at')->useCurrent();
        });    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
};
