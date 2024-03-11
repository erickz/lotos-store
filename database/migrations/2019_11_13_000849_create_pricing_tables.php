<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePricingTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pricing_features', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->index();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('pricing', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('active')->default(1);
            $table->string('name', 50);
            $table->double('price', 15, 2);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('pricing_feature', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('feature_id');
            $table->unsignedInteger('pricing_id');

            $table->foreign('feature_id')->references('id')->on('pricing_features')->onDelete('cascade');
            $table->foreign('pricing_id')->references('id')->on('pricing')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pricing_feature');
        Schema::dropIfExists('pricing');
        Schema::dropIfExists('pricing_features');
    }
}
