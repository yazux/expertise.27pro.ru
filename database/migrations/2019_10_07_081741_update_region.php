<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRegion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('regions')) Schema::table('regions', function (Blueprint $table) {
            $table->string('password')->nullable()->default('1234');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('regions')) Schema::table('regions', function (Blueprint $table) {
            $table->dropColumn(['password']);
        });
    }
}
