<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventorContactInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventor_contact_informations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('agent_name')->nullable();
            $table->string('agent_email_id')->nullable();
            $table->string('manager_name')->nullable();
            $table->string('manager_email_id')->nullable();
            $table->string('legal_name')->nullable();
            $table->string('legal_email_id')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_email_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventor_contact_informations');
    }
}
