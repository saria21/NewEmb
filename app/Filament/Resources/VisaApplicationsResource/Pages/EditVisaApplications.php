<?php

namespace App\Filament\Resources\VisaApplicationsResource\Pages;

use App\Filament\Resources\VisaApplicationsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVisaApplications extends EditRecord
{
    protected static string $resource = VisaApplicationsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
