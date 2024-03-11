<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConcursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('concursos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('store_id')->nullable()->default(1);
            $table->foreign('store_id')->references('id')->on('stores');
            $table->unsignedInteger('lotery_id');
            $table->foreign('lotery_id')->references('id')->on('loteries');
            $table->boolean('active')->default(1);
            $table->tinyInteger('type')->default(1);
            $table->mediumInteger('number');
            $table->date('draw_day');
            $table->string('draw_numbers');
            $table->string("draw_numbers_2");
            $table->double('value_accumulated', 15, 2)->nullable();
            $table->double('next_expected_prize', 15,2);
            $table->json('results');
            $table->json('results_2');
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
        Schema::dropIfExists('concursos');
    }
}
