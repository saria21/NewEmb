<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VisaApplicantsResource\Pages;
use App\Models\visa_applicants as VisaApplicantsModel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class VisaApplicantsResource extends Resource
{
    protected static ?string $model = VisaApplicantsModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('full_name')
                    ->label('Full Name')
                    ->required(),

                Forms\Components\TextInput::make('passport_number')
                    ->label('Passport Number')
                    ->required(),

                Forms\Components\Select::make('nationality')
                    ->label('Nationality')
                    ->options([
                        'Syrian' => 'Syrian',
                        'Japanese' => 'Japanese',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('applicant_id')
                    ->label('ID')
                    ->sortable(),

                Tables\Columns\TextColumn::make('full_name')
                    ->label('Full Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('passport_number')
                    ->label('Passport Number')
                    ->searchable(),

                Tables\Columns\TextColumn::make('nationality')
                    ->label('Nationality')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Syrian' => 'info',
                        'Japanese' => 'success',
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
            'index' => Pages\ListVisaApplicants::route('/'),
            'create' => Pages\CreateVisaApplicants::route('/create'),
            'edit' => Pages\EditVisaApplicants::route('/{record}/edit'),
        ];
    }
}
