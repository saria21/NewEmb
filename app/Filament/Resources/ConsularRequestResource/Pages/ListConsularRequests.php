<?php

namespace App\Filament\Resources\ConsularRequestResource\Pages;

use App\Filament\Resources\ConsularRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListConsularRequests extends ListRecords
{
    protected static string $resource = ConsularRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
