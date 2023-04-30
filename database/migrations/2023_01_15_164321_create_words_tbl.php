<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWordsTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('words', function (Blueprint $table) {
            $table->id();
            $table->string('eng');
            $table->string('per');
            $table->tinyInteger('chapter');
            $table->tinyInteger('unit');
            $table->boolean('test_tik');
            $table->boolean('fa_test_tik');
            $table->string('description');
            $table->string('example');
            $table->string('example_trs')->nullable();
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
        Schema::dropIfExists('words');
    }
}
