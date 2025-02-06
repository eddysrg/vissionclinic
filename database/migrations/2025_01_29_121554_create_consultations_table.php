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
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medical_record_sections_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->time('time');
            $table->string('consultation_type');
            $table->enum('medical_chart', ['yes', 'no']);
            $table->enum('respiratory_symptom', ['yes', 'no']);
            $table->enum('nutritional_status', ['underweight', 'normal_weight', 'overweight', 'obesity_one', 'obesity_two', 'obesity_three']);
            $table->string('current_condition');
            $table->string('patient_fasting');
            $table->string('weight');
            $table->string('height');
            $table->string('imc');
            $table->string('icc');
            $table->string('heart_rate');
            $table->string('respiratory_rate');
            $table->string('temperature');
            $table->string('glycemia');
            $table->string('blood_pressure');
            $table->string('oxygen_saturation');
            $table->text('physical_examination');
            $table->text('management_plan');
            $table->text('analysis');
            $table->text('diagnostic_impression');
            $table->text('forecast');
            $table->json('diseases')->nullable();
            $table->json('procedures')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
