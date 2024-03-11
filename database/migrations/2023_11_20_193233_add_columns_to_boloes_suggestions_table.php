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
        Schema::table('boloes_suggestions', function (Blueprint $table) {
            $table->integer('cotas')->nullable()->after('chances');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('boloes_suggestions', function (Blueprint $table) {
            $table->dropColumn('cotas');
        });
    }
};
