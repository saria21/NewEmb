<?php

namespace App\Filament\Resources\RelatedBuildingsResource\Pages;

use App\Filament\Resources\RelatedBuildingsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRelatedBuildings extends ListRecords
{
    protected static string $resource = RelatedBuildingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
