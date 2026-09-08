<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VisaApplicationsResource\Pages;
use App\Models\visa_applications as VisaApplicationsModel; // 🟢 قراءة الموديل الصغير الصحيح بالشحطة التحتية
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class VisaApplicationsResource extends Resource
{
    protected static ?string $model = VisaApplicationsModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // 🟢 منسدلة خيارات ثابتة وذكية لأنواع الفيزا المزرعة بالـ DBeaver
                Forms\Components\Select::make('visa_type')
                    ->label('Visa Type')
                    ->options([
                        'Business' => 'Business',
                        'Work' => 'Work',
                        'Student' => 'Student',
                    ])
                    ->required(),

                // 🟢 منسدلة خيارات ثابتة ملونة لحالة طلب الفيزا
                Forms\Components\Select::make('application_status')
                    ->label('Application Status')
                    ->options([
                        'Pending' => 'Pending',
                        'Approved' => 'Approved',
                        'Rejected' => 'Rejected',
                    ])
                    ->required(),

                // 🟢 رقم معرّف المتقدم بطلب الفيزا
                Forms\Components\TextInput::make('applicant_id')
                    ->label('Applicant ID')
                    ->numeric()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // 🟢 معرّف الطلب الأساسي مطابق للـ DBeaver بالظبط
                Tables\Columns\TextColumn::make('application_id')
                    ->label('ID')
                    ->sortable(),

                // 🟢 رقم مقدم الطلب متراص تماماً كشكل الـ DBeaver
                Tables\Columns\TextColumn::make('applicant_id')
                    ->label('Applicant ID')
                    ->sortable()
                    ->searchable(),

                // 🟢 نوع الفيزا (Business, Work, Student...)
                Tables\Columns\TextColumn::make('visa_type')
                    ->label('Visa Type')
                    ->searchable()
                    ->sortable(),

                // 🟢 حالة طلب الفيزا مع تلوين فخم جداً (Badge)
                Tables\Columns\TextColumn::make('application_status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Approved' => 'success',
                        'Pending' => 'warning',
                        'Rejected' => 'danger',
                        default => 'gray',
                    })
                    ->searchable(),
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
            'index' => Pages\ListVisaApplications::route('/'),
            'create' => Pages\CreateVisaApplications::route('/create'),
            'edit' => Pages\EditVisaApplications::route('/{record}/edit'),
        ];
    }
}
