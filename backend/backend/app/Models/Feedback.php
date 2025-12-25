<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Feedback extends Model
{
    protected $table = 'feedbacks';
    protected $primaryKey = 'feedback_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'feedback_id',
        'draft_id',
        'customer_id',
        'comment',
        'is_approved',
        'is_read',
        'attachment_url',
        'attachment_name'
    ];

    protected $casts = [
        'is_approved' => 'boolean',
        'is_read' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function draft(): BelongsTo
    {
        return $this->belongsTo(DraftVersion::class, 'draft_id', 'draft_id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id', 'user_id');
    }
}

