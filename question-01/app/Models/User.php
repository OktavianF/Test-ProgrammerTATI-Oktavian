<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Role constants
     */
    const ROLE_KEPALA_DINAS = 'kepala_dinas';
    const ROLE_KEPALA_BIDANG = 'kepala_bidang';
    const ROLE_STAFF = 'staff';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'supervisor_id',
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

    /**
     * Get the supervisor of this user
     */
    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }

    /**
     * Get all subordinates (direct reports)
     */
    public function subordinates(): HasMany
    {
        return $this->hasMany(User::class, 'supervisor_id');
    }

    /**
     * Get all daily logs for this user
     */
    public function dailyLogs(): HasMany
    {
        return $this->hasMany(DailyLog::class);
    }

    /**
     * Get all logs verified by this user
     */
    public function verifiedLogs(): HasMany
    {
        return $this->hasMany(DailyLog::class, 'verified_by');
    }

    /**
     * Check if user is Kepala Dinas
     */
    public function isKepalaDinas(): bool
    {
        return $this->role === self::ROLE_KEPALA_DINAS;
    }

    /**
     * Check if user is Kepala Bidang
     */
    public function isKepalaBidang(): bool
    {
        return $this->role === self::ROLE_KEPALA_BIDANG;
    }

    /**
     * Check if user is Staff
     */
    public function isStaff(): bool
    {
        return $this->role === self::ROLE_STAFF;
    }

    /**
     * Check if user has subordinates (is a supervisor)
     */
    public function hasSubordinates(): bool
    {
        return $this->subordinates()->exists();
    }

    /**
     * Check if user can verify logs (has subordinates)
     */
    public function canVerifyLogs(): bool
    {
        return $this->hasSubordinates();
    }

    /**
     * Get role display name
     */
    public function getRoleDisplayAttribute(): string
    {
        return match($this->role) {
            self::ROLE_KEPALA_DINAS => 'Kepala Dinas',
            self::ROLE_KEPALA_BIDANG => 'Kepala Bidang',
            self::ROLE_STAFF => 'Staff',
            default => ucfirst($this->role),
        };
    }
}
