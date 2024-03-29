<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
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
            $table->string('name');
            $table->string('email')->unique();
            //$table->tinyInteger('role')->default('0');
            $table->enum('role', ['user', 'admin'])->default('user');
            $table->enum('status', ['0', '1'])->default('1');
            //$table->tinyInteger('status')->default('0');
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
}
