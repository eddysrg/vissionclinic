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
        Schema::create('medical_consultations', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('time');
            $table->string('type_of_consultation');
            $table->enum('medical_card', ['yes', 'no']);
            $table->enum('respiratory_symptoms', ['yes', 'no']);
            $table->string('nutritional_status');
            $table->text('reason_for_consultation');
            $table->boolean('fasting_patient');
            $table->string('weight');
            $table->string('height');
            $table->string('imc');
            $table->string('icc');
            $table->string('frecuencia_cardiaca');
            $table->string('frecuencia_respiratoria');
            $table->string('temperatura');
            $table->string('glucemia');
            $table->string('presion_arterial');
            $table->string('saturacion_oxigeno');
            $table->text('physical_examination');
            $table->text('management_plan');
            $table->text('analysis');
            $table->text('diagnostic_impression');
            $table->text('prognosis');
            $table->json('diseases');
            $table->json('procedures');
            $table->foreignId('appointment_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_consultations');
    }
};
