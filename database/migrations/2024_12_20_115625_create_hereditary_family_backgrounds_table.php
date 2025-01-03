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
        Schema::create('hereditary_family_backgrounds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medical_record_sections_id')->constrained()->cascadeOnDelete();
            $table->json('paternal_family_data');
            $table->json('maternal_family_data');
            $table->text('observations')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hereditary_family_backgrounds');
    }
};
