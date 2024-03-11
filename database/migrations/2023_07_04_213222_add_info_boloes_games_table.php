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
        Schema::table('boloes_games', function (Blueprint $table) {
            $table->integer('quantity_numbers')->nullable()->after('number_match');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('boloes_games', function (Blueprint $table) {
            $table->dropColumn("quantity_numbers");
        });
    }
};
