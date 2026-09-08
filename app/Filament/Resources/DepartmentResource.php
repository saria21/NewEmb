<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DepartmentResource\Pages;
use App\Models\department as DepartmentModel; // 🟢 قراءة الموديل الصغير الصحيح لمشروعكِ
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DepartmentResource extends Resource
{
    protected static ?string $model = DepartmentModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // 🟢 صندوق نصي لإدخال اسم القسم
                Forms\Components\TextInput::make('name')
                    ->label('Department Name')
                    ->required(),

                // 🟢 منسدلة ذكية تختار المبنى برقم المعرف
                Forms\Components\Select::make('building_id')
                    ->label('Building')
                    ->relationship('building', 'name') // ربط العلاقة تلقائياً مع جدول المباني
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // 🟢 عرض رقم القسم الأساسي من الداتا بيز متل الـ DBeaver
                Tables\Columns\TextColumn::make('department_id')
                    ->label('ID')
                    ->sortable(),

                // 🟢 عرض اسم القسم (Visa Section, Consular Services...)
                Tables\Columns\TextColumn::make('name')
                    ->label('Department Name')
                    ->searchable()
                    ->sortable(),

                // 🟢 عرض اسم المبنى التابع له بدلاً من مجرد رقم تافه
                Tables\Columns\TextColumn::make('building.name')
                    ->label('Building Location')
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
            'index' => Pages\ListDepartments::route('/'),
            'create' => Pages\CreateDepartment::route('/create'),
            'edit' => Pages\EditDepartment::route('/{record}/edit'),
        ];
    }
}
