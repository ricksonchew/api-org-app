<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yoyo_notes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('note_id');
            $table->string('note_title', 255);
            $table->longText('note_text');
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
        Schema::drop('yoyo_notes');
    }
}
