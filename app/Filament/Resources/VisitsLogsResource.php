<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VisitsLogsResource\Pages;
use App\Models\visits_logs as VisitsLogsModel; // 🟢 قراءة الموديل الصغير الصحيح بالشحطة التحتية
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class VisitsLogsResource extends Resource
{
    protected static ?string $model = VisitsLogsModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // 🟢 رقم معرّف الزائر
                Forms\Components\TextInput::make('visitor_id')
                    ->label('Visitor ID')
                    ->numeric()
                    ->required(),

                // 🟢 رقم معرّف الموظف المستقبل للزيارة
                Forms\Components\TextInput::make('staff_id')
                    ->label('Staff ID')
                    ->numeric()
                    ->required(),

                // 🟢 حقل توقيت الدخول
                Forms\Components\DateTimePicker::make('check_in_time')
                    ->label('Check-In Time')
                    ->required(),

                // 🟢 حقل توقيت الخروج (اختياري لأن بعض الزوار لم يخرجوا بعد)
                Forms\Components\DateTimePicker::make('check_out_time')
                    ->label('Check-Out Time'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // 🟢 معرّف الزيارة الأساسي مطابق للـ DBeaver بالظبط
                Tables\Columns\TextColumn::make('visit_id')
                    ->label('ID')
                    ->sortable(),

                // 🟢 رقم الزائر
                Tables\Columns\TextColumn::make('visitor_id')
                    ->label('Visitor ID')
                    ->sortable()
                    ->searchable(),

                // 🟢 اسم الموظف المسؤول المربوط بالزيارة بدلاً من الرقم التافه
                Tables\Columns\TextColumn::make('staff.full_name')
                    ->label('Handled By Staff')
                    ->sortable(),

                // 🟢 توقيت الدخول
                Tables\Columns\TextColumn::make('check_in_time')
                    ->label('Check-In')
                    ->dateTime()
                    ->sortable(),

                // 🟢 توقيت الخروج مع إعطاء كلمة 'Still Inside' بلون رمادي لو كان فارغاً
                Tables\Columns\TextColumn::make('check_out_time')
                    ->label('Check-Out')
                    ->dateTime()
                    ->placeholder('Still Inside')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVisitsLogs::route('/'),
            'create' => Pages\CreateVisitsLogs::route('/create'),
            'edit' => Pages\EditVisitsLogs::route('/{record}/edit'),
        ];
    }
}
