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
        Schema::create('chronic_degenerative_diseases', function (Blueprint $table) {
            $table->id();
            $table->string('disease');
            $table->boolean('applies')->default(false);
            $table->text('observations')->nullable();
            $table->foreignId('pathological_history_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chronic_degenerative_diseases');
    }
};
