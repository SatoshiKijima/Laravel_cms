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
        Schema::create('support_users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('pref');
            $table->string('city');
            $table->date('birthday');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable()->default(null);
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
        Schema::dropIfExists('support_users');
    }
};
