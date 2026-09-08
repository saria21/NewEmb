<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Filament\Widgets\InterviewsReport;
use App\Filament\Widgets\EmbassyTrafficReport;
use App\Filament\Widgets\ApplicantVisaFrequency;

class Reports extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-chart-bar'; // أيقونة رسم بياني فخمة
    protected static ?string $navigationLabel = 'Reports & Analytics'; // الاسم الظاهر بالقائمة
    protected static string $view = 'filament.pages.reports';

    // 🟢 ربط وحقن التقارير الثلاثة لتظهر داخل هذه الصفحة المخصصة حصراً
    protected function getHeaderWidgets(): array
    {
        return [
            InterviewsReport::class,
            EmbassyTrafficReport::class,
            ApplicantVisaFrequency::class,
        ];
    }
}
