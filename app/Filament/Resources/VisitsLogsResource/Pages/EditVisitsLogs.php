<?php

namespace App\Filament\Resources\VisitsLogsResource\Pages;

use App\Filament\Resources\VisitsLogsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVisitsLogs extends EditRecord
{
    protected static string $resource = VisitsLogsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
