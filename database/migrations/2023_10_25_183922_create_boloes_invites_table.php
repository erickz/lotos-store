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
        Schema::create('boloes_invites', function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('bolao_id')->nullable();
            $table->unsignedBigInteger('owner_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->boolean('claimed')->default(0);
            $table->string('token', 100)->nullable();
            $table->string('email', 150)->nullable();
            $table->smallInteger('cotas')->nullable();
            $table->datetime('expire_at')->nullable();
            $table->timestamps();

            $table->foreign('bolao_id')->references('id')->on('boloes');
            $table->foreign('owner_id')->references('id')->on('customers');
            $table->foreign('customer_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boloes_invites');
    }
};
