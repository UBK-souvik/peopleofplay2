<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('awards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('year_established')->nullable();
            $table->string('year_dissolved')->nullable();
            $table->longText('events_associated_with')->nullable();
            $table->longText('previous_year_recipients')->nullable();
            $table->longText('previous_year_products')->nullable();
            $table->string('status')->default(1)->comment('0: Inactive, 1: Active');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('awards');
    }
}
