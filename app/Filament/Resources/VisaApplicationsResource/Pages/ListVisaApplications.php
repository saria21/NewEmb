<?php

namespace App\Filament\Resources\VisaApplicationsResource\Pages;

use App\Filament\Resources\VisaApplicationsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVisaApplications extends ListRecords
{
    protected static string $resource = VisaApplicationsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
