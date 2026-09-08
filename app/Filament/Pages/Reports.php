<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Filament\Widgets\InterviewsReport;
use App\Filament\Widgets\EmbassyTrafficReport;
use App\Filament\Widgets\ApplicantVisaFrequency;

class Reports extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-chart-bar'; 
    protected static ?string $navigationLabel = 'Reports & Analytics'; 
    protected static ?int $navigationSort = 99; // الحفاظ على موقعه بأسفل القائمة الجانبية
    protected static string $view = 'filament.pages.reports';
    

    protected function getHeaderWidgets(): array
    {
        return [
            InterviewsReport::class,
            EmbassyTrafficReport::class,
            ApplicantVisaFrequency::class,
        ];
    }
}

