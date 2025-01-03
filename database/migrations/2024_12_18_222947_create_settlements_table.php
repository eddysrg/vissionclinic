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
        Schema::create('settlements', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('postal_codes_id')->constrained()->onDelete('cascade');
            $table->foreignId('settlement_types_id')->constrained()->onDelete('cascade');
            $table->foreignId('municipalities_id')->constrained()->onDelete('cascade');
            $table->foreignId('states_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settlements');
    }
};
