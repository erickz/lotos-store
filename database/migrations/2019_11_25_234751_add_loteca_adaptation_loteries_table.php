<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLotecaAdaptationLoteriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lotery_costs', function(Blueprint $table){
            $table->integer('double')->after('lotery_id')->nullable();
            $table->integer('triple')->after('double')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lotery_costs', function(Blueprint $table){
            $table->dropColumn('double');
            $table->dropColumn('triple');
        });
    }
}
