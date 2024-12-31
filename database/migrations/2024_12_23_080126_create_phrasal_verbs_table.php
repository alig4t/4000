<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhrasalVerbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phrasal_verbs', function (Blueprint $table) {
            $table->id();
            $table->string('eng');
            $table->string('per');
            $table->tinyInteger('chapter');
            $table->boolean('test_tik')->default(0);
            $table->boolean('fa_test_tik')->default(0);
            $table->string('description')->nullable();
            $table->string('example')->nullable();
            $table->string('example_trs')->nullable();
            $table->string('description')->nullable();
            $table->string('example2')->nullable();
            $table->string('example_trs2')->nullable();
            $table->string('example3')->nullable();
            $table->string('example_trs3')->nullable();
            $table->string('example4')->nullable();
            $table->string('example_trs4')->nullable();
            $table->string('example5')->nullable();
            $table->string('example_trs5')->nullable();
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
        Schema::dropIfExists('phrasal_verbs');
    }
}
