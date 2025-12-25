<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DesignRequest extends Model
{
    protected $table = 'design_requests';
    protected $primaryKey = 'request_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'request_id',
        'customer_id',
        'designer_id',
        'title',
        'description',
        'category',
        'budget',
        'deadline',
        'status',
        'reference_files'
    ];

    protected $casts = [
        'budget' => 'decimal:2',
        'deadline' => 'date',
        'reference_files' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Relationships
    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id', 'user_id');
    }

    public function designer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'designer_id', 'user_id');
    }

    public function quotes(): HasMany
    {
        return $this->hasMany(Quote::class, 'request_id', 'request_id');
    }

    public function drafts(): HasMany
    {
        return $this->hasMany(DraftVersion::class, 'request_id', 'request_id');
    }

    public function review()
    {
        return $this->hasOne(Review::class, 'request_id', 'request_id');
    }
}

