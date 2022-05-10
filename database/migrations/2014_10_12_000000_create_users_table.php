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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fname');
            $table->string('lname');
            $table->string('referer')->nullable();
            $table->enum('user_type',['admin','user'])->default('user');
            $table->string('bvn')->nullable();
            $table->decimal('vault')->default(0.00);
            $table->decimal('savings')->default(0.00);
            $table->decimal('equity')->default(0.00);
            $table->decimal('pocket_mooney')->default(0.00);
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('phone');
            $table->enum("status",["active", "suspended"])->default('active');
            $table->enum("current_status",['online', 'offline'])->default('offline');
            $table->string('mcode')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
