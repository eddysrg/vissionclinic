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
            $table->text('habitus_exterior');
            $table->text('aparato_respiratorio');
            $table->string('aparato_respiratorio_status');
            $table->text('aparato_digestivo');
            $table->string('aparato_digestivo_status');
            $table->text('aparato_cardiovascular');
            $table->string('aparato_cardiovascular_status');
            $table->text('aparato_genitourinario');
            $table->string('aparato_genitourinario_status');
            $table->text('sistema_nervioso');
            $table->string('sistema_nervioso_status');
            $table->text('sistema_musculoesqueletico');
            $table->string('sistema_musculoesqueletico_status');
            $table->text('craneo');
            $table->string('craneo_status');
            $table->text('cara');
            $table->string('cara_status');
            $table->text('ojos');
            $table->string('ojos_status');
            $table->text('nariz');
            $table->string('nariz_status');
            $table->text('boca');
            $table->string('boca_status');
            $table->text('cuello');
            $table->string('cuello_status');
            $table->text('torax');
            $table->string('torax_status');
            $table->text('abdomen');
            $table->string('abdomen_status');
            $table->text('extremidades');
            $table->string('extremidades_status');
            $table->foreignId('medical_record_id')->constrained()->onDelete('cascade');
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
