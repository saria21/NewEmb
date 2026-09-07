<?php

namespace App\Filament\Resources\ConsularRequestResource\Pages;

use App\Filament\Resources\ConsularRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditConsularRequest extends EditRecord
{
    protected static string $resource = ConsularRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
