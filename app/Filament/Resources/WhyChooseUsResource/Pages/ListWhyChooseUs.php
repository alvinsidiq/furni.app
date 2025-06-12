<?php

namespace App\Filament\Resources\WhyChooseUsResource\Pages;

use App\Filament\Resources\WhyChooseUsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWhyChooseUs extends ListRecords
{
    protected static string $resource = WhyChooseUsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
