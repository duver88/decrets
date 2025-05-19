<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

        public function categoryPermissions()  
    {  
        return $this->hasMany(UserCategoryPermission::class);  
    }  

        public function categories()  
    {  
        return $this->belongsToMany(Category::class, 'user_category_permissions')  
                    ->withPivot(['can_create', 'can_edit', 'can_delete']);  
    }  
        public function hasPermissionFor($categoryId, $permission)  
    {  
        $categoryPermission = $this->categoryPermissions()  
                                   ->where('category_id', $categoryId)  
                                   ->first();  
          
        if (!$categoryPermission) {  
            return false;  
        }  
          
        return $categoryPermission->{'can_' . $permission} === true;  
    }  

    // Relaciones para Relatoría conceptos
        public function concepts()
        {
            return $this->hasMany(Concept::class);
        }

        public function conceptTypes()
        {
            return $this->belongsToMany(ConceptType::class, 'user_concept_permissions')
                ->withPivot('can_create', 'can_edit', 'can_delete')
                ->withTimestamps();
        }

        public function hasConceptPermissionFor($conceptTypeId, $permission = 'create')
        {
            $permissionColumn = 'can_' . $permission;
            
            return $this->is_admin || $this->conceptTypes()
                ->where('concept_type_id', $conceptTypeId)
                ->wherePivot($permissionColumn, true)
                ->exists();
        }
}
