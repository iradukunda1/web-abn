<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsumedStockOutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumed_stock_outs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stockIn_id')->onDelete('cascade');
            $table->foreignId('stockOut_id')->onDelete('cascade');
            $table->integer('quantity_stockIn');
            $table->integer('quantity_stockOut');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consumed_stock_outs');
    }
}
