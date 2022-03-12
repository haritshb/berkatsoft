<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id')->unsigned()->index(); // this is working            
            $table->bigInteger('product_id')->unsigned()->index(); // this is working            
            $table->timestamps();
            
        });
        /*
        Schema::table('sales_orders', function($table) {
            $table->foreign('customer_id')->references('id')->on('customers');
        });

        Schema::table('sales_orders', function($table) {
            $table->foreign('product_id')->references('id')->on('products');
        });
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_orders');
    }
}
