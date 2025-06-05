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
        Schema::table('concepts', function (Blueprint $table) {
            // Agregar el nuevo campo
            $table->string('dependencia')->nullable()->after('tipo_documento');
        });

        // Migrar datos existentes si los hay
        $concepts = DB::table('concepts')->whereNotNull('dependencias')->get();
        foreach ($concepts as $concept) {
            $dependenciasArray = json_decode($concept->dependencias, true);
            if (is_array($dependenciasArray) && !empty($dependenciasArray)) {
                // Tomar la primera dependencia del array
                DB::table('concepts')
                    ->where('id', $concept->id)
                    ->update(['dependencia' => $dependenciasArray[0]]);
            }
        }

        Schema::table('concepts', function (Blueprint $table) {
            // Eliminar el campo antiguo
            $table->dropColumn('dependencias');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('concepts', function (Blueprint $table) {
            $table->json('dependencias')->nullable()->after('tipo_documento');
            $table->dropColumn('dependencia');
        });
    }
};