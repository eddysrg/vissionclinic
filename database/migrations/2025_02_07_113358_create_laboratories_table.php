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
        Schema::create('laboratories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medical_record_sections_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->time('time');
            $table->string('service');
            $table->string('is_urgent');
            $table->string('sample_type');
            $table->string('diagnosis');
            $table->string('special_studies');
            $table->string('folio');
            $table->json('hematology')->nullable();
            $table->json('coagulation')->nullable();
            $table->json('clinicalChemistry')->nullable();
            $table->json('immunology')->nullable();
            $table->json('cytology')->nullable();
            $table->json('urologyAndCoprology')->nullable();
            $table->json('microbiology')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laboratories');
    }
};
