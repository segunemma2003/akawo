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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('withdrawal_method')->default('manual');
            $table->string('full_name')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('address')->nullable();
            $table->string('allow_email')->default('false');
            $table->string('2fa')->default('false');
            $table->string('phone_not')->default('false');
            $table->string('post_debit')->default('false');
            $table->string('allow_web_sound')->default('false');
            $table->string('tips')->default('false');
            $table->string('news')->default('false');
            $table->string('show_tour')->default('false');
            $table->string('mode')->default('light');
            $table->string('fullscreen')->default('false');
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
        Schema::dropIfExists('settings');
    }
};
