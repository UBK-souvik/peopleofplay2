<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMainListPageDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_list_page_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('main_list_page_id')->nullable();
            $table->tinyInteger('type')
                ->nullable()
                ->comment('1: Toys, 2: Games, 3: Companies, 4: Inventors,5: Events');
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
        Schema::dropIfExists('main_list_page_details');
    }
}
