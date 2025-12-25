<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DraftVersion extends Model
{
    protected $table = 'draft_versions';
    protected $primaryKey = 'draft_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'draft_id',
        'request_id',
        'version_number',
        'file_url',
        'file_name',
        'file_size',
        'file_type',
        'description',
        'status'
    ];

    protected $casts = [
        'file_size' => 'integer',
        'uploaded_at' => 'datetime',
        'approved_at' => 'datetime'
    ];

    public function request(): BelongsTo
    {
        return $this->belongsTo(DesignRequest::class, 'request_id', 'request_id');
    }

    public function feedbacks(): HasMany
    {
        return $this->hasMany(Feedback::class, 'draft_id', 'draft_id');
    }
}

