<?php

namespace App\Filament\Resources\RelatedBuildingsResource\Pages;

use App\Filament\Resources\RelatedBuildingsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRelatedBuildings extends EditRecord
{
    protected static string $resource = RelatedBuildingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
