<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = ['nombre','numero', 'tipo', 'fecha', 'archivo', 'descripcion', 'category_id','document_type_id', 'document_theme_id'];

        public function documentType()  
    {  
        return $this->belongsTo(DocumentType::class);  
    }  
    
    public function documentTheme()  
    {  
        return $this->belongsTo(DocumentTheme::class);  
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}