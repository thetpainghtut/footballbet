<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentBetrateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_betrate', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('betrate_id');
            $table->unsignedBigInteger('agent_id');
            $table->string('bet_amount');
            $table->boolean('betting_team_status')->nullable();
            $table->boolean('betting_total_goal_status')->nullable();
            $table->integer('goal_different_equal')->nullable();
            $table->integer('goal_different_greater')->nullable();
            $table->integer('goal_different_less')->nullable();
            $table->integer('status');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('betrate_id')
                    ->references('id')->on('betrates')
                    ->onDelete('cascade');
            $table->foreign('agent_id')
                    ->references('id')->on('agents')
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
        Schema::dropIfExists('agent_betrate');
    }
}
