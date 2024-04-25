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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->bigInteger('RoleId')->default(1);
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->date('dob');
            $table->bigInteger('mobile')->nullable();
            $table->integer('country_code')->nullable();
            $table->string('provider_name')->nullable();
            $table->text('provider_id')->nullable();
            $table->text('profile_image')->nullable();
            $table->string('password');
            $table->tinyInteger('Status')->default(1);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
