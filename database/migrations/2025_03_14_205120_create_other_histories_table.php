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
        Schema::create('other_histories', function (Blueprint $table) {
            $table->id();
            $table->string('type_of_history');
            $table->date('date')->nullable();
            $table->text('type_of_examination')->nullable();
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
        Schema::dropIfExists('other_histories');
    }
};
