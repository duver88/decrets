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
       Schema::create('user_category_permissions', function (Blueprint $table) {  
            $table->id();  
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  
            $table->foreignId('category_id')->constrained()->onDelete('cascade');  
            $table->boolean('can_create')->default(false);  
            $table->boolean('can_edit')->default(false);  
            $table->boolean('can_delete')->default(false);  
            $table->timestamps();   
              
            // Índice compuesto para búsquedas eficientes  
            $table->unique(['user_id', 'category_id']);  
             });  
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
          Schema::dropIfExists('user_category_permissions'); 
    }
};
