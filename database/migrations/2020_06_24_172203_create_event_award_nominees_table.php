<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventAwardNomineesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_award_nominees', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('event_award_id')->nullable();
            $table->tinyInteger('type')->nullable()->comment('1: Product, 2: User');
            $table->integer('reference_id')->nullable();
            $table->string('reference')->nullable();
            $table->tinyInteger('reference_type')->nullable()->comment('1: Relation, 2: String');
            $table->tinyInteger('is_winner')->default(0)->comment('0: No, 1: Yes');
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
        Schema::dropIfExists('event_award_nominees');
    }
}
