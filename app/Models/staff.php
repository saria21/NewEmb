<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class staff extends Authenticatable
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

    public function visitsLogs(): HasMany
    {
        return $this->hasMany(
            visits_logs::class,
            'staff_id',
            'staff_id'
        );
    }
}