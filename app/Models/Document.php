<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'tipo', 'fecha', 'archivo', 'descripcion', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}