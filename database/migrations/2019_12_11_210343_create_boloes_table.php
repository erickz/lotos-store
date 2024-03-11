<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoloesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boloes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('store_id')->nullable()->default(1);
            $table->foreign('store_id')->references('id')->on('stores');
            $table->unsignedInteger('lotery_id');
            $table->foreign('lotery_id')->references('id')->on('loteries');
            $table->unsignedBigInteger('concurso_id');
            $table->foreign('concurso_id')->references('id')->on('concursos');
            $table->boolean('active')->default(1);
            $table->tinyInteger('type')->default(1);
            $table->tinyInteger('featured')->default(1);
            $table->string('name', 150);
            $table->smallInteger('cotas');
            $table->smallInteger('cotas_available');
            $table->text('description');
            $table->double('price', 15, 2);
            $table->double('prize', 15, 2);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('boloes_buyers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customer_id')->nullable()->default(1);
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->unsignedBigInteger('bolao_id')->nullable()->default(1);
            $table->foreign('bolao_id')->references('id')->on('boloes');
            $table->timestamps();
        });

        Schema::create('boloes_games', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('bolao_id')->nullable()->default(1);
            $table->foreign('bolao_id')->references('id')->on('boloes');
            $table->boolean('checked')->default(0);
            $table->boolean('prized')->default(0);
            $table->tinyInteger('number_match')->nullable();
            $table->string('numbers');
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
        Schema::dropIfExists('boloes_games');
        Schema::dropIfExists('boloes_buyers');
        Schema::dropIfExists('boloes');
    }
}
