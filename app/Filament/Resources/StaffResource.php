<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StaffResource\Pages;
use App\Models\staff as StaffModel; // 🟢 قراءة موديل الستاف الصغير
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class StaffResource extends Resource
{
    protected static ?string $model = StaffModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // 🟢 الاسم الكامل للستاف
                Forms\Components\TextInput::make('full_name')
                    ->label('Full Name')
                    ->required(),

                // 🟢 البريد الإلكتروني
                Forms\Components\TextInput::make('email')
                    ->label('Email Address')
                    ->email()
                    ->required(),

                // 🟢 المسمى الوظيفي
                Forms\Components\TextInput::make('job_title')
                    ->label('Job Title')
                    ->required(),

                // 🟢 منسدلة الخيارات الثابتة للـ Role المتوافقة مع الـ canAccessPanel
                Forms\Components\Select::make('role')
                    ->label('Role')
                    ->options([
                        'Admin' => 'Admin',
                        'Officer' => 'Officer',
                        'Coordinator' => 'Coordinator',
                        'Staff' => 'Staff',
                    ])
                    ->required(),

                // 🟢 منسدلة ذكية تختار القسم برقم المعرف مع عرض الاسم
                Forms\Components\Select::make('department_id')
                    ->label('Department')
                    ->relationship('department', 'name')
                    ->required(),

                // 🟢 حقل الباسورد (يظهر إجباري فقط عند الإنشاء ومخفي عند التعديل)
                Forms\Components\TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->dehydrateStateUsing(fn ($state) => \Illuminate\Support\Facades\Hash::make($state))
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $context): bool => $context === 'create'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // 🟢 معرّف الستاف مطابق للـ DBeaver بالظبط
                Tables\Columns\TextColumn::make('staff_id')
                    ->label('ID')
                    ->sortable(),

                // 🟢 الاسم الكامل للموظف
                Tables\Columns\TextColumn::make('full_name')
                    ->label('Full Name')
                    ->searchable()
                    ->sortable(),

                // 🟢 المسمى الوظيفي
                Tables\Columns\TextColumn::make('job_title')
                    ->label('Job Title')
                    ->searchable(),

                // 🟢 الـ Role مع تلوين فخم
                Tables\Columns\TextColumn::make('role')
                    ->label('Role')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Admin' => 'success',
                        'Officer' => 'info',
                        'Coordinator' => 'warning',
                        default => 'gray',
                    }),

                // 🟢 البريد الإلكتروني
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),

                // 🟢 اسم القسم المربوط بالموظف
                Tables\Columns\TextColumn::make('department.name')
                    ->label('Department'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // 🟢 تفعيل ميزة الحذف الجماعي لـ عجة يوزرات من برّا بضربة واحدة
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
            'index' => Pages\ListStaff::route('/'),
            'create' => Pages\CreateStaff::route('/create'),
            'edit' => Pages\EditStaff::route('/{record}/edit'),
        ];
    }
}
