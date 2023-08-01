<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('amount')->comment('Сумма денег на перевод');
            $table->unsignedBigInteger('sender_id')->nullable()->comment('id отправителя');
            $table->unsignedBigInteger('receiver_id')->nullable()->comment('id получателя');
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('set null');
            $table->string('status')->index()->comment('Статус перевода');
            $table->timestamp('send_date')->nullable()->comment('Дата, когда перевод должен быть выполнен');
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
        Schema::dropIfExists('transfers');
    }
}
