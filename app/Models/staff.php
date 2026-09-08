<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName; // 🟢 استدعاء ميزة الاسم القياسية للفيلمنت
use Filament\Panel;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class staff extends Authenticatable implements FilamentUser, HasName
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'staff';
    protected $primaryKey = 'staff_id';
    protected $fillable = [
        'full_name',
        'job_title',
        'role',
        'department_id',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    /**
     * إرجاع حقل الاسم الصحيح المتوافق مع الفيلمنت لمنع خطأ الـ null
     */
    public function getFilamentName(): string
    {
        return $this->full_name ?? 'Staff Member';
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return in_array($this->role, [
            'Admin',
            'Officer',
            'Coordinator',
            'Staff',
        ], true);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(
            department::class,
            'department_id',
            'department_id'
        );
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(
            appointments::class,
            'interviewer_staff_id',
            'staff_id'
        );
    }
}
