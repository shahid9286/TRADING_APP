<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SystemLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'module',
        'action',
        'log_level',
        'user_id',
        'affected_user_id',
        'loggable_id',
        'loggable_type',
        'amount',
        'commission_rate',
        'level',
        'description',
        'details',
        'metadata',
        'ip_address',
        'user_agent',
        'status',
        'processed_at'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'commission_rate' => 'decimal:2',
        'metadata' => 'array',
        'processed_at' => 'datetime'
    ];

    /**
     * Get the user who performed the action
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the affected user
     */
    public function affectedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'affected_user_id');
    }

    /**
     * Get the related model
     */
    public function loggable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Scope queries by module
     */
    public function scopeModule($query, $module)
    {
        return $query->where('module', $module);
    }

    /**
     * Scope queries by action
     */
    public function scopeAction($query, $action)
    {
        return $query->where('action', $action);
    }

    /**
     * Scope queries by log level
     */
    public function scopeLevel($query, $level)
    {
        return $query->where('log_level', $level);
    }

    /**
     * Scope queries by user
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope queries by affected user
     */
    public function scopeAffectingUser($query, $userId)
    {
        return $query->where('affected_user_id', $userId);
    }

    /**
     * Create a new system log entry
     */
    public static function createLog(array $data): self
    {
        return self::create(array_merge([
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'user_id' => auth()->id(),
        ], $data));
    }
}