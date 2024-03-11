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
        Schema::table('loteries', function (Blueprint $table) {
            $table->integer('min_match')->nullable()->after('max_numbers');
            $table->integer('max_match')->nullable()->after('min_match');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('loteries', function (Blueprint $table) {
            $table->dropColumn('min_match');
            $table->dropColumn('max_match');
        });
    }
};
