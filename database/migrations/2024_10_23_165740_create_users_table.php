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
            $table->string('degree')->nullable();
            $table->string('name');
            $table->string('last_name');
            $table->enum('gender', ['male', 'female']);
            $table->date('birthdate');
            $table->string('phone_number', 10);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('rfc', 13)->unique();
            $table->string('curp', 18)->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('profile_photo')->nullable();
            $table->rememberToken();
            $table->foreignId('medical_unit_id')->constrained()->onDelete('cascade');
            $table->foreignId('role_id')->constrained()->onDelete('cascade');
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
