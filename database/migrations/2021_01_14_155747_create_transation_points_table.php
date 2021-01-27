<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransationPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transation_points', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('from');
            $table->unsignedBigInteger('to');
            $table->unsignedBigInteger('match_id')->nullable();
            $table->unsignedBigInteger('transation_type_id');
            $table->integer('points');
            $table->string('description');
            $table->softDeletes();
            $table->foreign('from')
                    ->references('id')->on('users')
                    ->onDelete('cascade');
            $table->foreign('to')
                    ->references('id')->on('users')
                    ->onDelete('cascade');
            $table->foreign('transation_type_id')
                    ->references('id')->on('transation_types')
                    ->onDelete('cascade');
            $table->foreign('match_id')
                    ->references('id')->on('matches')
                    ->onDelete('cascade');
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
        Schema::dropIfExists('transation_points');
    }
}
