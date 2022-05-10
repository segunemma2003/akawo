<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('user_id');
            $table->string('card_no');
            $table->string('expiry_date');
            $table->string('cvv');
            $table->string('channel')->nullable();
            $table->string('channel_id')->nullable();
            $table->string('account_number')->nullable();
            $table->string('recipient_code')->nullable();
            $table->string('reference')->nullable();
            $table->string('last4')->nullable();
            $table->string('account_name')->nullable();
            $table->string('signature')->nullable();
            $table->string('bank')->nullable();
            $table->string('bank_code')->nullable();
            $table->string('authorization_code')->nullable();
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
        Schema::dropIfExists('cards');
    }
};
