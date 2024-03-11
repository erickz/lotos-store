<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('active')->default(0);
            $table->boolean('newsletter')->default(1);
            $table->boolean('genre')->default(1);
            $table->string('cpf', 15)->nullable();
            $table->string('cnpj', 20)->nullable();
            $table->string('first_name', 30);
            $table->string('last_name', 100);
            $table->string('phone', 16)->nullable();
            $table->string('email', 100)->unique();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('customer_banks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customer_id');
            $table->string('bearer', 100);
            $table->char('agency', 4);
            $table->string('bank', 50);
            $table->char('type', 2);
            $table->char('code_bank', 10);
            $table->string('account_number', 50);
            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('customer_banks');
        Schema::dropIfExists('customers');
    }
}
