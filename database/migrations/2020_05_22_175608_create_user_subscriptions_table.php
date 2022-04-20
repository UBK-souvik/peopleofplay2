<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_subscriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedInteger('plan_id')->nullable();
            $table->string('stripe_id')->nullable();
            $table->string('stripe_plan_id')->nullable();
            $table->decimal('price')->nullable();
            $table->decimal('validity')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->string('stripe_subscription_id')->nullable();
            $table->string('payment_status')->default(1)->comment('0: Pending, 1: Failed, 2: Success, 3: Dispute');
            $table->string('status')->default(1)->comment('0: Pending, 1: Active, 2: Renewed, 3: Expired');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('plan_id')->references('id')->on('plans')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_subscriptions');
    }
}
