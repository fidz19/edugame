<?php

namespace App\Filament\Resources\GameTemplateResource\Pages;

use App\Filament\Resources\GameTemplateResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGameTemplates extends ListRecords
{
    protected static string $resource = GameTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
