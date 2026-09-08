<?php

namespace App\Filament\Widgets;

use App\Models\appointments;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class InterviewsReport extends BaseWidget
{
    // ترتيب ظهور الصف بالداشبورد (الأول بالأعلى دائماً)
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        // 1. حساب عدد مقابلات الموظف الحالي من الداتا بيز
        $count = appointments::where('interviewer_staff_id', auth()->id())->count();

        // 2. حساب وجلب التوقيت والتاريخ الفعلي الحالي لسوريا بالثانية
        $now = Carbon::now('Asia/Damascus');
        $currentDate = $now->format('l, F j, Y');
        $currentTime = $now->format('h:i A');

        return [
            // الكرت الأول: المقابلات ويجلس في جهة اليسار تلقائياً
            Stat::make('Interviews Performed', $count)
                ->description('Total interviews handled by your account')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success'),

            // الكرت الثاني: الساعة والوقت الحقيقي ويجلس بجانبه في نفس السطر تماماً
            Stat::make('Current Date & Time', $currentTime)
                ->description($currentDate)
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('primary'),
        ];
    }
}
