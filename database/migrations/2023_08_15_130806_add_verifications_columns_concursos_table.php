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
        Schema::table('concursos', function (Blueprint $table) {
            $table->boolean('checked')->default(0)->after('type');
            $table->boolean('prized')->default(0)->after('checked');
            $table->boolean('revenued')->default(0)->after('prized');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('concursos', function (Blueprint $table) {
            $table->dropColumn('checked');
            $table->dropColumn('prized');
            $table->dropColumn('revenued');
        });
    }
};
