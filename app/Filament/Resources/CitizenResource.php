<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CitizenResource\Pages;
use App\Models\citizen as CitizenModel; // 🟢 قراءة موديل المواطن الصحيح المفرد
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CitizenResource extends Resource
{
    protected static ?string $model = CitizenModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // 🟢 صناديق الإدخال المتوافقة بالملي مع حقول قاعدة البيانات الحقيقية
                Forms\Components\TextInput::make('full_name')
                    ->label('Full Name')
                    ->required(),

                Forms\Components\TextInput::make('passport_number')
                    ->label('Passport Number')
                    ->required(),

                Forms\Components\TextInput::make('current_address')
                    ->label('Current Address')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // 🟢 عرض المعرّف الأساسي للمواطن
                Tables\Columns\TextColumn::make('citizen_id')
                    ->label('ID')
                    ->sortable(),

                // 🟢 عرض الاسم الكامل للمواطن
                Tables\Columns\TextColumn::make('full_name')
                    ->label('Full Name')
                    ->searchable()
                    ->sortable(),

                // 🟢 عرض رقم الجواز (بدل الإيميل القديم الفاضي)
                Tables\Columns\TextColumn::make('passport_number')
                    ->label('Passport Number')
                    ->searchable()
                    ->sortable(),

                // 🟢 عرض العنوان الحالي (بدل الهاتف القديم الفاضي)
                Tables\Columns\TextColumn::make('current_address')
                    ->label('Current Address')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                // 🟢 تفعيل زر التعديل والحذف بشكل مستقر
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
            'index' => Pages\ListCitizens::route('/'),
            'create' => Pages\CreateCitizen::route('/create'),
            'edit' => Pages\EditCitizen::route('/{record}/edit'),
        ];
    }
}
