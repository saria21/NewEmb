<?php

namespace App\Filament\Resources\VisitsLogsResource\Pages;

use App\Filament\Resources\VisitsLogsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVisitsLogs extends ListRecords
{
    protected static string $resource = VisitsLogsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
