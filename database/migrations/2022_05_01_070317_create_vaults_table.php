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
        Schema::create('vaults', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->enum('type',['savings','vault']);
            $table->string('name');
            $table->enum('interval',['daily','weekly','monthly']);
            $table->string('start_date');
            $table->string('end_date');
            $table->decimal("expected_amount")->default(0.00);
            $table->string("status")->default("ongoing");
            $table->decimal("amount")->default((0.00));
            $table->string('billing_method')->nullable();
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
        Schema::dropIfExists('vaults');
    }
};
