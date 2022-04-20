<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedInteger('type_of_industry')->nullable();
            $table->unsignedInteger('type_of_user')->default(1)->comment('1: Standard, 2: Paid');
            $table->unsignedInteger('role')->default(1)->comment('1: Standard, 2: Inventor, 3: Company');

            $table->foreign('country_id')->references('id')->on('countries')->onDelete('set null');
            $table->foreign('type_of_industry')->references('id')->on('type_of_industries')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('country_id');
            $table->dropColumn('type_of_user');
            $table->dropColumn('role');
            $table->dropColumn('type_of_industry');
        });
    }
}
