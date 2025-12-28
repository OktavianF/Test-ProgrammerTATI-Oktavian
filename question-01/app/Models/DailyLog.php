<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class DailyLog extends Model
{
    use HasFactory;

    /**
     * Status constants
     */
    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'date',
        'activity',
        'status',
        'verified_by',
        'verified_at',
        'approval_note',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'date' => 'date',
            'verified_at' => 'datetime',
        ];
    }

    /**
     * Get the user who owns this log
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the user who verified this log
     */
    public function verifier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    /**
     * Check if log is pending
     */
    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    /**
     * Check if log is approved
     */
    public function isApproved(): bool
    {
        return $this->status === self::STATUS_APPROVED;
    }

    /**
     * Check if log is rejected
     */
    public function isRejected(): bool
    {
        return $this->status === self::STATUS_REJECTED;
    }

    /**
     * Check if log is auto-approved (Kepala Dinas)
     */
    public function isAutoApproved(): bool
    {
        return $this->user && $this->user->isKepalaDinas() && $this->isApproved();
    }

    /**
     * Check if log can be edited
     * - Pending logs can be edited
     * - Kepala Dinas auto-approved logs can also be edited (by owner)
     */
    public function canBeEdited(): bool
    {
        if ($this->isPending()) {
            return true;
        }
        
        // Kepala Dinas can edit their own auto-approved logs
        return $this->isAutoApproved();
    }

    /**
     * Check if log can be deleted
     * - Pending logs can be deleted
     * - Kepala Dinas auto-approved logs can also be deleted (by owner)
     */
    public function canBeDeleted(): bool
    {
        if ($this->isPending()) {
            return true;
        }
        
        // Kepala Dinas can delete their own auto-approved logs
        return $this->isAutoApproved();
    }

    /**
     * Scope for pending logs
     */
    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    /**
     * Scope for approved logs
     */
    public function scopeApproved(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_APPROVED);
    }

    /**
     * Scope for rejected logs
     */
    public function scopeRejected(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_REJECTED);
    }

    /**
     * Scope for logs from specific user
     */
    public function scopeForUser(Builder $query, int $userId): Builder
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope for logs from subordinates of a user
     */
    public function scopeForSubordinatesOf(Builder $query, User $supervisor): Builder
    {
        $subordinateIds = $supervisor->subordinates()->pluck('id');
        return $query->whereIn('user_id', $subordinateIds);
    }

    /**
     * Get status badge CSS class
     */
    public function getStatusBadgeClassAttribute(): string
    {
        return match($this->status) {
            self::STATUS_PENDING => 'bg-yellow-100 text-yellow-800',
            self::STATUS_APPROVED => 'bg-green-100 text-green-800',
            self::STATUS_REJECTED => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    /**
     * Get status display name
     */
    public function getStatusDisplayAttribute(): string
    {
        return match($this->status) {
            self::STATUS_PENDING => 'Pending',
            self::STATUS_APPROVED => 'Disetujui',
            self::STATUS_REJECTED => 'Ditolak',
            default => ucfirst($this->status),
        };
    }
}
