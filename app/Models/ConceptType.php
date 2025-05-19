<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ConceptType extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion'];

    public function themes()
    {
        return $this->hasMany(ConceptTheme::class, 'concept_type_id');
    }

    public function concepts()
    {
        return $this->hasMany(Concept::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_concept_permissions')
            ->withPivot('can_create', 'can_edit', 'can_delete')
            ->withTimestamps();
    }
}
