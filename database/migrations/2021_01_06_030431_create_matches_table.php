<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('league_id');
            $table->unsignedBigInteger('home_team_id');
            $table->unsignedBigInteger('away_team_id');
            $table->string('event_date');
            $table->string('event_time');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('home_team_id')
                    ->references('id')->on('teams')
                    ->onDelete('cascade');

            $table->foreign('away_team_id')
                    ->references('id')->on('teams')
                    ->onDelete('cascade');

            $table->foreign('league_id')
                    ->references('id')->on('leagues')
                    ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matches');
    }
}
