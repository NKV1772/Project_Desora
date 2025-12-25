<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Quote extends Model
{
    protected $table = 'quotes';
    protected $primaryKey = 'quote_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'quote_id',
        'request_id',
        'designer_id',
        'price',
        'estimated_days',
        'description',
        'status',
        'rejection_reason'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function request(): BelongsTo
    {
        return $this->belongsTo(DesignRequest::class, 'request_id', 'request_id');
    }

    public function designer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'designer_id', 'user_id');
    }
}

