<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Concept extends Model
{
      use HasFactory;

    protected $fillable = [
        'titulo', 
        'contenido', 
        'archivo', 
        'concept_type_id', 
        'concept_theme_id', 
        'user_id',
        'tipo_documento',
        'año',
        'fecha'
    ];

    protected $casts = [
        'fecha' => 'date'
    ];

    public function conceptType()
    {
        return $this->belongsTo(ConceptType::class);
    }

    public function conceptTheme()
    {
        return $this->belongsTo(ConceptTheme::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
