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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string("name", 50)->collation("utf8mb4_0900_ai_ci");
            $table->string("code", 50)->collation("utf8mb4_0900_ai_ci");
            $table->string("phone_code", 50)->collation("utf8mb4_0900_ai_ci");
            $table->text("flag", 50)->collation("utf8mb4_0900_ai_ci");
            $table->boolean("status")->default(0)->comment("0: N/A, 1: A");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
