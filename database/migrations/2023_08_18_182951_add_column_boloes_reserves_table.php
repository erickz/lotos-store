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
        Schema::table('boloes_reserves', function (Blueprint $table) {
            $table->boolean('processed')->default(0)->after('cotas');
            $table->datetime('expiration_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('boloes_reserves', function (Blueprint $table) {
            $table->dropColumn('processed');
            $table->dropColumn('expiration_date');
        });
    }
};
