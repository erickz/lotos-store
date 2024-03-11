<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('pricing_id')->nullable();
            $table->boolean('active')->default(1);
            $table->string('name', 100);
            $table->string('alias', 30)->unique();
            $table->text('description');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('pricing_id')->references('id')->on('pricing');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
    }
}
