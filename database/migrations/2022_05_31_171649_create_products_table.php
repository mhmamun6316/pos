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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('sku');
            $table->foreignId('outlet_id')->constrained('outlets')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->string('barcode_type')->nullable();
            $table->integer('alert_quantity')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('brochure')->nullable();
            $table->string('custom1')->nullable();
            $table->string('custom2')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('applicable_tax')->nullable();
            $table->decimal('exc_purchase_price',10,2);
            $table->decimal('inc_purchase_price',10,2);
            $table->decimal('selling_price',10,2);
            $table->string('margin');
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
        Schema::dropIfExists('products');
    }
};
