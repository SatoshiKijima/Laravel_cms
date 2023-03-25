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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('support_user_id');
            $table->foreign('support_user_id')->references('id')->on('support_users')->onDelete('cascade');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->unsignedBigInteger('area_id')->nullable();
            $table->foreign('area_id')->references('id')->on('prefectures')->onDelete('cascade')->nullable();
            $table->unsignedBigInteger('giftcard_id')->nullable();
            $table->foreign('giftcard_id')->references('id')->on('gift_cards')->onDelete('cascade')->nullable();;
            $table->integer('numbers');
            $table->string('gift_sender')->nullable();
            $table->string('message')->nullable();
            $table->integer('use')->nullable();
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
        //
    }
};
