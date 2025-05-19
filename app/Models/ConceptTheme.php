<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ConceptTheme extends Model
{
     use HasFactory;

    protected $fillable = ['nombre', 'concept_type_id'];

    public function conceptType()
    {
        return $this->belongsTo(ConceptType::class);
    }

    public function concepts()
    {
        return $this->hasMany(Concept::class);
    }
}
