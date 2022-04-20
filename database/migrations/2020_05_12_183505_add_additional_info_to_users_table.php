<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdditionalInfoToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('user_id_number')->nullable();
            $table->string('description')->nullable();
            $table->string('username')->nullable();
            $table->string('postal_address')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('website')->nullable();
            $table->string('business_address')->nullable();
            $table->date('dob')->nullable();
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
            $table->dropColumn('user_id_number');
            $table->dropColumn('description');
            $table->dropColumn('username');
            $table->dropColumn('postal_address');
            $table->dropColumn('zip_code');
            $table->dropColumn('city');
            $table->dropColumn('state');
            $table->dropColumn('website');
            $table->dropColumn('business_address');
            $table->dropColumn('dob');
        });
    }
}
