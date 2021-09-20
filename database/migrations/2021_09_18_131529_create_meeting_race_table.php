<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingRaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting_race', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('meeting_id')->unsigned()->index();
            $table->bigInteger('race_id')->unsigned()->index();
            $table->foreign('meeting_id')->references('id')->on('meetings');
            $table->foreign('race_id')->references('id')->on('races');
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
        Schema::dropIfExists('meeting_race');
    }
}
