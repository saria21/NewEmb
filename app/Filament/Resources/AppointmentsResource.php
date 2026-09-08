<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AppointmentsResource\Pages;
use App\Models\appointments as AppointmentsModel; // 🟢 قراءة الموديل الصغير النظيف
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AppointmentsResource extends Resource
{
    protected static ?string $model = AppointmentsModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // 🟢 صندوق نصي لإدخال الغرض من الزيارة
                Forms\Components\TextInput::make('purpose_of_visit')
                    ->label('Purpose of Visit')
                    ->required(),

                // 🟢 صندوق اختيار التاريخ والوقت للموعد
                Forms\Components\DateTimePicker::make('appointment_date')
                    ->label('Appointment Date')
                    ->required(),

                // 🟢 حقول إدخال المعرفات الرقمية المتوافقة مع الـ SQLite
                Forms\Components\TextInput::make('applicant_id')
                    ->label('Applicant ID')
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('citizen_id')
                    ->label('Citizen ID')
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('interviewer_staff_id')
                    ->label('Interviewer Staff ID')
                    ->numeric()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // 🟢 عرض رقم الموعد الأساسي من الداتا بيز
                Tables\Columns\TextColumn::make('appointment_id')
                    ->label('ID')
                    ->sortable(),

                // 🟢 عرض الغرض من الزيارة (Visa Interview, Passport Renewal... إلخ)
                Tables\Columns\TextColumn::make('purpose_of_visit')
                    ->label('Purpose of Visit')
                    ->searchable(),

                // 🟢 عرض تاريخ ووقت الموعد المزرع بالسيدر
                Tables\Columns\TextColumn::make('appointment_date')
                    ->label('Appointment Date')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                // 🟢 زر التعديل الفوري شغال ومقفل
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // 🟢 زر الحذف الجماعي شغال تماماً
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
            'index' => Pages\ListAppointments::route('/'),
            'create' => Pages\CreateAppointments::route('/create'),
            'edit' => Pages\EditAppointments::route('/{record}/edit'),
        ];
    }
}
