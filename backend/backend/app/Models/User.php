<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
    use HasApiTokens;

    protected $table = 'users';
    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'email',
        'password',
        'full_name',
        'phone',
        'avatar_url',
        'role',
        'is_verified',
        'is_active'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Relationships
    public function customerRequests(): HasMany
    {
        return $this->hasMany(DesignRequest::class, 'customer_id', 'user_id');
    }

    public function designerRequests(): HasMany
    {
        return $this->hasMany(DesignRequest::class, 'designer_id', 'user_id');
    }

    public function portfolios(): HasMany
    {
        return $this->hasMany(Portfolio::class, 'designer_id', 'user_id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'designer_id', 'user_id');
    }
}

