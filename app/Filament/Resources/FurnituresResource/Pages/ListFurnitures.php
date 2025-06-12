<?php

namespace App\Filament\Resources\FurnituresResource\Pages;

use App\Filament\Resources\FurnituresResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFurnitures extends ListRecords
{
    protected static string $resource = FurnituresResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
