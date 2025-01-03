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
        Schema::create('pathological_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medical_record_sections_id')->constrained()->onDelete('cascade');
            $table->json('exanthematic_diseases')->nullable();
            $table->json('chronic_degenerative_diseases')->nullable();
            $table->json('other_diseases');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pathological_histories');
    }
};
