<?php

namespace App\Filament\Resources\OrangTuaResource\Pages;

use App\Filament\Resources\OrangTuaResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewOrangTua extends ViewRecord
{
    protected static string $resource = OrangTuaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
