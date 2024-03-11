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
        Schema::table('lotery_costs', function (Blueprint $table) {
            $table->double('cost', 15, 2)->nullable()->after('prize');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lotery_costs', function (Blueprint $table) {
            $table->dropColumn('cost');
        });
    }
};
