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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('outlet_id');
            $table->string('invoice_no');
            $table->string('md_discount')->nullable();
            $table->string('special_discount')->nullable();
            $table->string('parcent_discount')->nullable();
            $table->string('vat')->nullable();
            $table->string('status');
            $table->decimal('pay_amount',10,2)->nullable();
            $table->string('due_amount')->nullable();
            $table->string('installment_type')->nullable();
            $table->string('payment_method')->nullable();
            $table->decimal('total',8,2);
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('sales');
    }
};
