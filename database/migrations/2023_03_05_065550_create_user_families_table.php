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
        Schema::create('user_families', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('ユーザーID'); // 👈 追加
            $table->unsignedBigInteger('family_id')->comment('家族構成ID'); // 👈 追加
            // $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // 👈 追加
            $table->foreign('family_id')->references('id')->on('families')->onDelete('cascade'); // 👈 追加
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_families');
    }
};
