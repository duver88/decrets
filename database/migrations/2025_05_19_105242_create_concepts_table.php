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
        Schema::create('concepts', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('contenido')->nullable();
            $table->string('archivo');
            $table->foreignId('concept_type_id')->constrained();
            $table->foreignId('concept_theme_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->string('año');
            $table->date('fecha');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('concepts');
    }
};
