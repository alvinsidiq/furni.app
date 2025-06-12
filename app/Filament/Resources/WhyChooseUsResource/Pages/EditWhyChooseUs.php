<?php

namespace App\Filament\Resources\WhyChooseUsResource\Pages;

use App\Filament\Resources\WhyChooseUsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWhyChooseUs extends EditRecord
{
    protected static string $resource = WhyChooseUsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
