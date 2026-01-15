<?php

namespace App\Filament\Resources\GameTemplateResource\Pages;

use App\Filament\Resources\GameTemplateResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGameTemplate extends EditRecord
{
    protected static string $resource = GameTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
