<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventAwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_awards', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('event_id')->nullable();
            $table->unsignedInteger('category_id')->nullable();
            $table->unsignedInteger('award_id')->nullable();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('year_established')->nullable();
            $table->string('year_dissolved')->nullable();
            $table->longText('events_associated_with')->nullable();
            $table->longText('previous_year_recipients')->nullable();
            $table->longText('previous_year_products')->nullable();
            $table->timestamps();

            $table->foreign('event_id')->references('id')->on('events')->onDelete('set null');
            $table->foreign('award_id')->references('id')->on('awards')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_awards');
    }
}
