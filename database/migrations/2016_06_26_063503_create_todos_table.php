<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yoyo_todos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('todo_id');
            $table->string('todo_title', 255);
            $table->longText('todo_text');
            $table->boolean('is_done')->default(0);
            $table->dateTime('created_date');
            $table->dateTime('modified_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('yoyo_todos');
    }
}
