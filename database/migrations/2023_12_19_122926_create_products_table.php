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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('category_id')->constrained();
            $table->string('slug')->nullable();
            $table->string('shop_by_style')->nullable();
            $table->string('shop_by_shape')->nullable();
            $table->string('shop_by_metal')->nullable();
            $table->string('shop_by_material')->nullable();
            $table->json('item_detail')->nullable();
            $table->json('diamond_detail')->nullable();
            $table->json('side_diamond_detail')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
