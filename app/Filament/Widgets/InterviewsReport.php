<?php

namespace App\Filament\Widgets;

use App\Models\appointments;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class InterviewsReport extends BaseWidget
{
    // ترتيب ظهور الكرت بالداشبورد (الأول على اليسار)
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        // حساب عدد المقابلات في قاعدة البيانات المربوطة بمعرّف الموظف المسجل دخوله حالياً
        $count = appointments::where('interviewer_staff_id', auth()->id())->count();

        return [
            Stat::make('Interviews Performed', $count)
                ->description('Total interviews handled by your account')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success'),
        ];
    }
}
