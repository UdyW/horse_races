<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('races', function (Blueprint $table) {
            $table->id();
            $table->integer('race_id');
            $table->date('date');
            $table->time('time');
            $table->integer('runners');
            $table->boolean('handicap')->nullable();
            $table->boolean('trifecta')->nullable();
            $table->string('stewards')->nullable();
            $table->string('status')->nullable();
            $table->integer('revision')->nullable();
            $table->string('weather')->nullable();
            $table->string('brief')->nullable();
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
        Schema::dropIfExists('races');
    }
}
