<?php

namespace App\Filament\Widgets;

use App\Models\visa_applications;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\DB;

class ApplicantVisaFrequency extends BaseWidget
{
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                // 🟢 قراءة الـ query مع جلب علاقة الـ applicant لتفادي تكرار استعلامات الداتا بيز
                visa_applications::query()
                    ->with(['applicant'])
                    ->select('applicant_id', DB::raw('MIN(application_id) as application_id'), DB::raw('count(*) as total_applications'))
                    ->groupBy('applicant_id')
            )
            ->defaultPaginationPageOption(5) // 🟢 عرض 5 أسطر فقط بالصفحة
            ->paginationPageOptions([5, 10, 20]) // 🟢 تفعيل منسدلة الخيارات لشريط الأرقام كاملاً بأسفل الجدول
            ->columns([
                // 1. عرض معرّف الشخص الرقمي
                Tables\Columns\TextColumn::make('applicant_id')
                    ->label('Applicant ID')
                    ->sortable(),

                // 2. 🟢 جلب وعرض اسم مقدم طلب الفيزا الحقيقي من علاقة الـ applicant
                Tables\Columns\TextColumn::make('applicant.full_name')
                    ->label('Applicant Full Name')
                    ->searchable()
                    ->placeholder('Unknown Applicant'),

                // 3. عرض إجمالي عدد طلبات الفيزا المقدمة
                Tables\Columns\TextColumn::make('total_applications')
                    ->label('Total Visa Applications Filed')
                    ->badge()
                    ->color('danger')
                    ->sortable(),
            ]);
    }
}
