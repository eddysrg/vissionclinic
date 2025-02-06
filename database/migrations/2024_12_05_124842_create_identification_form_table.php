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
        Schema::create('identification_form', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medical_record_sections_id')->constrained()->onDelete('cascade');
            $table->enum('gender', ['male', 'female']);
            $table->string('gender_identity');
            $table->integer('age');
            $table->string('country');
            $table->string('state');
            $table->string('zip_code');
            $table->string('neighborhood');
            $table->string('street');
            $table->string('number');
            $table->string('religion');
            $table->string('schooling');
            $table->string('occupation');
            $table->string('marital_status');
            $table->string('landline');
            $table->string('cellphone');
            $table->string('email');
            $table->string('parent');
            $table->string('parent_phone');
            $table->string('relationship');
            $table->text('interrogation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('identification_form');
    }
};
