<?php

namespace App\Filament\Resources\GameTemplateResource\Pages;

use App\Filament\Resources\GameTemplateResource;
use Filament\Resources\Pages\CreateRecord;

class CreateGameTemplate extends CreateRecord
{
    protected static string $resource = GameTemplateResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();
        return $data;
    }
}
