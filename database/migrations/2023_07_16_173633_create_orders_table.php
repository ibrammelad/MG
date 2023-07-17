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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('table_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('reservation_id');
            $table->unsignedBigInteger('waiter_id')->nullable();
            $table->float('total');
            $table->boolean('paid');
            $table->date('date');
            $table->timestamps();

            $table->foreign('table_id')->on('tables')->references('id')
                ->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('customer_id')->on('customers')->references('id')
                ->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('reservation_id')->on('reservations')->references('id')
                ->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
