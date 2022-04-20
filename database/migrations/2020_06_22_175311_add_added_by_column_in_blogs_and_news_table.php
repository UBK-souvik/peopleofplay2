<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAddedByColumnInBlogsAndNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('news', function (Blueprint $table) {
            $table->tinyInteger('added_by')->default(1)->comment('1: User, 2: Admin');
        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->tinyInteger('added_by')->default(1)->comment('1: User, 2: Admin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropColumn('added_by');
        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn('added_by');
        });
    }
}
