<?php

namespace App\Filament\Resources\VisaApplicantsResource\Pages;

use App\Filament\Resources\VisaApplicantsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVisaApplicants extends EditRecord
{
    protected static string $resource = VisaApplicantsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
