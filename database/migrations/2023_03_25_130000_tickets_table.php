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
            $table->unsignedBigInteger('support_user_id')->nullable();;
            $table->foreign('support_user_id')->references('id')->on('support_users')->onDelete('set null');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('set null');
            $table->unsignedBigInteger('area_id')->nullable();
            $table->foreign('area_id')->references('id')->on('prefectures')->onDelete('set null');
            $table->unsignedBigInteger('giftcard_id')->nullable();
            $table->foreign('giftcard_id')->references('id')->on('gift_cards')->onDelete('set null');
            $table->integer('numbers');
            $table->string('gift_sender')->nullable();
            $table->string('message')->nullable();
            $table->integer('use')->nullable();
            $table->dateTime('get_date')->nullable();
            $table->dateTime('used_date')->nullable();
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
        Schema::dropIfExists('tickets');
    }
};
