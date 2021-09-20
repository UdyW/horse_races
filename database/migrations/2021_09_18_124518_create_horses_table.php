<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horses', function (Blueprint $table) {
            $table->id();
            $table->integer('horse_id');
            $table->string('name');
            $table->string('bred')->nullable();
            $table->string('status')->nullable();
            $table->integer('cloth_number');
            $table->integer('weight');
            $table->text('weight_text')->nullable();
            $table->bigInteger('jockey_id')->unsigned()->index()->nullable();
            $table->bigInteger('trainer_id')->unsigned()->index()->nullable();
            $table->foreign('jockey_id')->references('id')->on('jockeys');
            $table->foreign('trainer_id')->references('id')->on('trainers');
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
        Schema::dropIfExists('horses');
    }
}
