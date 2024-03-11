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
        Schema::table('boloes_buyers', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_id')->nullable()->after('customer_id');
            $table->boolean('is_owner')->default(0)->after('cotas');

            $table->foreign('parent_id')->references('id')->on('boloes_buyers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('boloes_buyers', function (Blueprint $table) {
            $table->dropColumn('parent_id'); 
            $table->dropColumn('is_owner'); 
        });
    }
};
