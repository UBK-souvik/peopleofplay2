<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomePageDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_page_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('home_page_id')->nullable();
            $table->tinyInteger('type')
                ->nullable()
                ->comment('1: Product, 2: Event, 3: Latest News, 4: NewsLetter,5: Birthdays and Anniversaries,6: Polls');
            $table->integer('reference_id')->nullable();
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
        Schema::dropIfExists('home_page_details');
    }
}
