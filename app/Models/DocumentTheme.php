<?php  
  
namespace App\Models;  
  
use Illuminate\Database\Eloquent\Model;  
use Illuminate\Database\Eloquent\Factories\HasFactory;  
  
class DocumentTheme extends Model  
{  
    use HasFactory;  
  
    protected $fillable = [  
        'nombre',  
        'document_type_id'  
    ];  
  
    public function documentType()  
    {  
        return $this->belongsTo(DocumentType::class);  
    }  
  
    public function documents()  
    {  
        return $this->hasMany(Document::class);  
    }  
}