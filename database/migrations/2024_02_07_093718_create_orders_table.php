<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('shipping_id');
            $table->foreignId('payment_id')->nullable()->unsigned();
            $table->integer('billing_id')->nullable()->unsigned();
            $table->string('contact_information')->default(null);
            $table->tinyInteger('same_as_shipping_address')->default(0)->comment("0: No, 1: Yes");
            $table->string('code');
            $table->float('amount')->default(0);
            $table->tinyInteger('status')->default(1)->comment('1. ordered ,2.prepared , 3.shipping , 4.delivered ,5.temp ');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
