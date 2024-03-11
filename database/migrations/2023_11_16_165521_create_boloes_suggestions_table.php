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
        Schema::create('boloes_suggestions', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('lotery_id');
            $table->foreign('lotery_id')->references('id')->on('loteries');
            $table->string('name')->nullable();
            $table->json('bets')->nullable();
            $table->integer('qt_bets')->nullable();
            $table->double('price', 15,2)->nullable();
            $table->integer('chances')->nullable();
            $table->double('receipt', 15,2)->nullable();

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
        Schema::dropIfExists('boloes_suggestions');
    }
};
