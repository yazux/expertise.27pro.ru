<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateNews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('news')) Schema::table('news', function (Blueprint $table) {
            $table->unsignedInteger('region_id')->nullable()->index('news_region_id_foreign');
        });

        if (Schema::hasTable('news')) Schema::table('news', function(Blueprint $table) {
            $table->foreign('region_id', 'news_region_id_foreign')->references('id')->on('regions')->onUpdate('NO ACTION')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('news')) Schema::table('news', function(Blueprint $table) {
            $table->dropForeign('news_region_id_foreign');
        });

        if (Schema::hasTable('news')) Schema::drop('region_id');
    }
}
