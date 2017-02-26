<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCounterTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counter_user_counter', function($table) {
            $table->increments('id');

            $table->string('class_name');
            $table->integer('object_id');
            $table->integer('user_id');

            $table->enum('action', ['like', 'view']);

            $table->timestamps();
            
            $table->index(['class_name', 'object_id', 'user_id', 'action']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('counter_user_counter');
    }

}
