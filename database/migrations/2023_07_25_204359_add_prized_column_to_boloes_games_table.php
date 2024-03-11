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
            $table->double('prize', 15, 2)->nullable()->after("cost");
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
            $table->dropColumn('prize');
        });
    }
};
