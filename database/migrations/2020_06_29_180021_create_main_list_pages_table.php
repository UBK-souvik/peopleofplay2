<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMainListPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_list_pages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('display_order')->nullable();
            $table->string('title')->nullable();
            $table->tinyInteger('type')
                ->nullable()
                ->comment('1: Toys, 2: Games, 3: Companies, 4: Inventors,5: Events');
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
        Schema::dropIfExists('main_list_pages');
    }
}
