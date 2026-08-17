<?php

namespace App\Filament\Resources\MediaLinkResource\Pages;

use App\Filament\Resources\MediaLinkResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMediaLinks extends ListRecords
{
    protected static string $resource = MediaLinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
