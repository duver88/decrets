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
        Schema::table('documents', function (Blueprint $table) {  
            $table->foreignId('document_type_id')->nullable()->constrained()->onDelete('set null');  
            $table->foreignId('document_theme_id')->nullable()->constrained()->onDelete('set null');  
        });  

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {  
            $table->dropForeign(['document_type_id']);  
            $table->dropForeign(['document_theme_id']);  
            $table->dropColumn(['document_type_id', 'document_theme_id']);  
        });  
    }
};
