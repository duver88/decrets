<?php

  
namespace App\Models;  
  
use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;  
  
class UserCategoryPermission extends Model  
{  
    use HasFactory;  
  
    protected $fillable = [  
        'user_id',  
        'category_id',  
        'can_create',  
        'can_edit',  
        'can_delete',  
    ];  
  
    protected $casts = [  
        'can_create' => 'boolean',  
        'can_edit' => 'boolean',  
        'can_delete' => 'boolean',  
    ];  
  
    public function user()  
    {  
        return $this->belongsTo(User::class);  
    }  
  
    public function category()  
    {  
        return $this->belongsTo(Category::class);  
    }  
}