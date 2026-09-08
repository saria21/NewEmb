<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConsularRequestResource\Pages;
use App\Models\consular_request as ConsularRequestModel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ConsularRequestResource extends Resource
{
    protected static ?string $model = ConsularRequestModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // 🟢 منسدلة الخيارات الثابتة لنوع الطلب القنصلي
                Forms\Components\Select::make('request_type')
                    ->label('Request Type')
                    ->options([
                        'Passport Renewal' => 'Passport Renewal',
                        'Visa Application' => 'Visa Application',
                        'Document Attestation' => 'Document Attestation',
                        'Notary Services' => 'Notary Services',
                    ])
                    ->required(),

                // 🟢 منسدلة الخيارات الثابتة لحالة الطلب
                Forms\Components\Select::make('request_status')
                    ->label('Request Status')
                    ->options([
                        'Pending' => 'Pending',
                        'Approved' => 'Approved',
                        'Rejected' => 'Rejected',
                    ])
                    ->required(),

                // 🟢 رقم معرّف المواطن
                Forms\Components\TextInput::make('citizen_id')
                    ->label('Citizen ID')
                    ->numeric()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // 🟢 معرّف الطلب الأساسي
                Tables\Columns\TextColumn::make('request_id')
                    ->label('ID')
                    ->sortable(),

                // 🟢 رقم المواطن (مطابق لشكل الـ DBeaver بالظبط)
                Tables\Columns\TextColumn::make('citizen_id')
                    ->label('Citizen ID')
                    ->sortable()
                    ->searchable(),

                // 🟢 نوع الطلب
                Tables\Columns\TextColumn::make('request_type')
                    ->label('Request Type')
                    ->searchable()
                    ->sortable(),

                // 🟢 حالة الطلب مع تلوين فخم لكل حالة (Badge)
                Tables\Columns\TextColumn::make('request_status')
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
            'index' => Pages\ListConsularRequests::route('/'),
            'create' => Pages\CreateConsularRequest::route('/create'),
            'edit' => Pages\EditConsularRequest::route('/{record}/edit'),
        ];
    }
}
