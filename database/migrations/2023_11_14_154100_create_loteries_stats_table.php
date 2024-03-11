<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loteries_stats', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('lotery_id');
            $table->foreign('lotery_id')->references('id')->on('loteries');
            $table->integer('number_dozens')->nullable();
            $table->string('odds')->nullable();
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
        Schema::dropIfExists('loteries_stats');
    }
};
