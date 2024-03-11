<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreLoteriesConfig extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_loteries_config', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('lotery_id');
            $table->unsignedBigInteger('store_id');
            $table->boolean('active')->default(1);
            $table->boolean('build_boloes')->default(0);
            $table->text('description');

            $table->foreign('lotery_id')->references('id')->on('loteries');
            $table->foreign('store_id')->references('id')->on('stores');
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
        Schema::dropIfExists('store_loteries_config');
    }
}
