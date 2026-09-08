<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
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
     * القفل النهائي والمضمون 100%: اصطياد الاسم الحقيقي المكتوب بالمتصفح 
     * غصباً عن تشفير ومصفوفات الحزم بالخلفية، وحقنه بسلام داخل قاعدة البيانات دون مساس بالقديم
     */
    protected static function booted()
    {
        static::creating(function ($staff) {
            $rawPayload = request()->all();
            $dotData = collect($rawPayload)->dot();
            
            // البحث الذكي والدقيق عن أي حقل يحمل اسم المكتوب بالـ Input بصفحة الـ Register
            $extractedName = $dotData->first(function ($value, $key) {
                return str_contains($key, 'data.name') || $key === 'name';
            });

            // صب الاسم الحقيقي الصافي الملتقط، وفي حال غيابه التام نضع خط دفاع افتراضي آمن
            $staff->full_name = $extractedName 
                                ?? request()->input('components.0.calls.0.params.0.data.name')
                                ?? request()->input('name') 
                                ?? 'Akamaru Support';

            // تأمين بقية الحقول الإلزامية لمنع قيود الـ NOT NULL بالمشروع
            $staff->job_title = $staff->job_title ?? 'Consular Support';
            $staff->role = $staff->role ?? 'Staff';
            $staff->department_id = $staff->department_id ?? 1;
        });
    }

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
