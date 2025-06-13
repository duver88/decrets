<?php  
  
namespace App\Models;  
  
use Illuminate\Database\Eloquent\Model;  
use Illuminate\Database\Eloquent\Factories\HasFactory;  
  
class DocumentType extends Model  
{  
    use HasFactory;  
  
    protected $fillable = [  
        'nombre',  
        'descripcion'  
    ];  
  
    public function documents()  
    {  
        return $this->hasMany(Document::class);  
    }  
  
    public function themes()  
    {  
        return $this->hasMany(DocumentTheme::class);  
    }  
  
    public function userPermissions()  
    {  
        return $this->hasMany(UserDocumentPermission::class);  
    }  
}