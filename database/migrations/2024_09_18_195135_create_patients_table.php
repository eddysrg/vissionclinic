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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('time');
            $table->string('doctor');
            $table->string('patient_name');
            $table->string('fathers_last_name');
            $table->string('mothers_last_name');
            $table->char('gender', 1);
            $table->integer('age');
            $table->string('phone_number', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
