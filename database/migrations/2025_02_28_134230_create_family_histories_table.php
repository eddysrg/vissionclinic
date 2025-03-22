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
        Schema::create('family_histories', function (Blueprint $table) {
            $table->id();
            $table->string('relative');
            $table->boolean('deceased');
            $table->boolean('hta');
            $table->boolean('dm');
            $table->boolean('neoplasms');
            $table->boolean('cardiopathies');
            $table->boolean('ophthalmological');
            $table->boolean('psychiatric');
            $table->boolean('neurological');
            $table->boolean('other');
            $table->text('observations')->nullable();
            $table->foreignId('medical_record_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_histories');
    }
};
