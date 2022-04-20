<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePollAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poll_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ip')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedInteger('poll_id')->nullable();
            $table->string('question')->nullable();
            $table->unsignedInteger('option_id')->nullable();
            $table->tinyInteger('type')
                ->nullable()
                ->comment('1: Product, 2: Event, 3: Inventors, 4: Companies');
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
        Schema::dropIfExists('poll_answers');
    }
}
