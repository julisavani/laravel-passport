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
        Schema::create('customer_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id');
            $table->string('name');
            $table->text('address1');
            $table->text('address2')->default(null)->nullable();
            $table->string('city');
            $table->foreignId('state_id');
            $table->foreignId('country_id');
            $table->string('postal_code');
            $table->boolean('status')->default(1);
            $table->tinyInteger('address_type')->default(0)->comment("0: Home, 1: Office");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_addresses');
    }
};
