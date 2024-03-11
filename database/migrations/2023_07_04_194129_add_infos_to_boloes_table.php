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
        Schema::table('boloes', function (Blueprint $table) {
            $table->integer('visits')->default('0')->after('checked');
            $table->integer('quantity_games')->default('0')->after('visits');
            $table->integer('total_value')->nullable()->after('quantity_games');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('boloes', function (Blueprint $table) {
            $table->dropColumn('visits');
            $table->dropColumn('quantity_games');
            $table->dropColumn('total_value');
        });
    }
};
