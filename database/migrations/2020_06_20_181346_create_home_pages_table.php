<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_pages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('display_order')->nullable();
            $table->string('title')->nullable();
            $table->tinyInteger('type')
                ->nullable()
                ->comment('1: Product, 2: Event, 3: Latest News, 4: NewsLetter,5: Birthdays and Anniversaries,6: Polls');
            $table->tinyInteger('status')->default(1)->comment('0: Inactive, 1:Active');
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
        Schema::dropIfExists('home_pages');
    }
}
