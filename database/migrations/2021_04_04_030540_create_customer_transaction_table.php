<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_transaction', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->string('category_purchase')->nullable();
            $table->string('serial_code')->nullable();
            $table->text('notes')->nullable();
            $table->date('warranty_end_date')->nullable();
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
        Schema::dropIfExists('customer_transaction');
    }
}
