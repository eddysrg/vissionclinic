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
        Schema::create('no_pathological_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medical_record_sections_id')->constrained()->onDelete('cascade');
            $table->json('blood_type')->nullable();
            $table->string('diet')->nullable();
            $table->string('physical_activity')->nullable();
            $table->string('hygiene')->nullable();
            $table->json('smoke')->nullable();
            $table->json('alcohol')->nullable();
            $table->json('drugs')->nullable();
            $table->string('housing_type')->nullable();
            $table->string('geographical_area')->nullable();
            $table->string('socioeconomic_level')->nullable();
            $table->json('services');
            $table->json('fauna');
            $table->json('promiscuity');
            $table->json('overcrowding');
            $table->json('immunizations');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('no_pathological_histories');
    }
};
