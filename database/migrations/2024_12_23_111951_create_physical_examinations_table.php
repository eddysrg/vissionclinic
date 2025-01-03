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
        Schema::create('physical_examinations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medical_record_sections_id')->constrained()->cascadeOnDelete();
            $table->date('date');
            $table->time('time');
            $table->string('weight');
            $table->string('height');
            $table->string('bmi');
            $table->string('chf');
            $table->string('heart_rate');
            $table->string('respiratory_rate');
            $table->string('temperature');
            $table->string('glycemia');
            $table->string('blood_pressure');
            $table->string('oxygen_saturation');
            $table->text('external_habitus');
            $table->json('test_systems')->nullable();
            $table->json('test_physical')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('physical_examinations');
    }
};
