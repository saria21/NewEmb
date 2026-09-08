<?php

namespace App\Filament\Widgets;

use App\Models\visits_logs;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class EmbassyTrafficReport extends BaseWidget
{
    // ترتيب الكرت (يظهر بالمرتبة الثانية بجانب الكرت الأول)
    protected static ?int $sort = 2;

    protected function getStats(): array
    {
        // دالة أساسية لفلترة واستثناء المراكز الأكاديمية بناءً على اسم القسم
        $baseQuery = visits_logs::whereHas('staff.department', function ($query) {
            $query->whereNotIn('name', [
                'Japanese Literature College', 
                'Japan Center', 
                'كلية الأدب الياباني', 
                'المركز الياباني'
            ]);
        });

        // 1. حساب زيارات اليوم (Temporal Grounding للـ SQLite)
        $daily = (clone $baseQuery)->whereDate('check_in_time', Carbon::today()->toDateString())->count();

        // 2. حساب زيارات الأسبوع
        $weekly = (clone $baseQuery)->whereBetween('check_in_time', [
            Carbon::now()->startOfWeek()->toDateTimeString(), 
            Carbon::now()->endOfWeek()->toDateTimeString()
        ])->count();

        // 3. حساب زيارات الشهر
        $monthly = (clone $baseQuery)->whereMonth('check_in_time', Carbon::now()->month)->count();

        return [
            Stat::make('Daily Traffic', $daily)
                ->description('Consulate visitors today')
                ->color('info'),
                
            Stat::make('Weekly Traffic', $weekly)
                ->description('This week total entries')
                ->color('warning'),
                
            Stat::make('Monthly Traffic', $monthly)
                ->description('This month total entries')
                ->color('primary'),
        ];
    }
}
