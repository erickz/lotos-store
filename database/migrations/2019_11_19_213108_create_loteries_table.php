<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoteriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loteries', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('active')->default(1);
            $table->char('initials', 2);
            $table->string('name', 35);
            $table->integer('biggest_number');
            $table->text('description');
            $table->string('draw_days', 25);
            $table->integer('number_games_payslip');
            $table->integer('min_numbers');
            $table->integer('max_numbers');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('lotery_costs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('lotery_id');
            $table->foreign('lotery_id')->references('id')->on('loteries');
            $table->integer('number_matches');
            $table->double('prize', 15, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lotery_costs');
        Schema::dropIfExists('loteries');
    }
}
