<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Portfolio extends Model
{
    protected $table = 'portfolios';
    protected $primaryKey = 'portfolio_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'portfolio_id',
        'designer_id',
        'title',
        'image_url',
        'category',
        'description',
        'tags',
        'is_approved',
        'view_count'
    ];

    protected $casts = [
        'tags' => 'array',
        'is_approved' => 'boolean',
        'view_count' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function designer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'designer_id', 'user_id');
    }
}

