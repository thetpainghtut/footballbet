<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBetratesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('betrates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('match_id');
            $table->string('team_bet_odd',10);
            $table->unsignedBigInteger('team_goal_different')->nullable();
            $table->boolean('odd_team_status');
            $table->string('team_goal_bet_odd',10);
            $table->unsignedBigInteger('team_goal')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('match_id')
                    ->references('id')->on('matches')
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
        Schema::dropIfExists('betrates');
    }
}
