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
        Schema::create('non_pathological_histories', function (Blueprint $table) {
            $table->id();
            $table->string('blood_type');
            $table->string('feeding');
            $table->string('physical_activity');
            $table->string('hygiene');
            $table->string('tobacco');
            $table->boolean('ex_smoker')->default(false);
            $table->text('smoker_observations')->nullable();
            $table->string('alcohol');
            $table->boolean('ex_alcoholic')->default(false);
            $table->text('alcoholic_observations')->nullable();
            $table->string('drug_addiction');
            $table->boolean('ex_drug_addict')->default(false);
            $table->text('drug_addiction_observations')->nullable();
            $table->string('type_of_housing');
            $table->string('geographical_area');
            $table->string('socioeconomic_level');
            $table->boolean('electricity_service')->default(false);
            $table->boolean('water_service')->default(false);
            $table->boolean('drainage_service')->default(false);
            $table->string('fauna');
            $table->text('fauna_observations')->nullable();
            $table->string('promiscuity');
            $table->text('promiscuity_observations')->nullable();
            $table->string('overcrowding');
            $table->text('overcrowding_observations')->nullable();
            $table->string('immunizations');
            $table->text('immunization_observations')->nullable();
            $table->foreignId('medical_record_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('non_pathological_histories');
    }
};
