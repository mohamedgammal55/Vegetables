<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
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
            $table->string('customer_name',500)->nullable();
            $table->double('total')->nullable()->default(0);
            $table->double('discount')->nullable()->default(0);
            $table->double('tax')->nullable()->default(0);
            $table->bigInteger('order_date_time')->nullable()->default(0);
            $table->string('is_back',5)->default('0')->nullable();

            $table->unsignedBigInteger('added_by_id')->nullable();
            $table->foreign('added_by_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

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
        Schema::dropIfExists('orders');
    }
}
