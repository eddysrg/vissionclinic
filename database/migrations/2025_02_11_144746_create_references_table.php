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
        Schema::create('references', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medical_record_sections_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->time('time');
            $table->string('is_urgent');
            $table->string('reference_unit');
            $table->string('reference_by');
            $table->string('clues');
            $table->string('entity');
            $table->string('health_institution');
            $table->string('destination_unit');
            $table->string('address');
            $table->string('service');
            $table->string('patient_on_fast');
            $table->string('reason_for_reference');
            $table->string('diagnostic_impression');
            $table->string('physical_folio');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('references');
    }
};
