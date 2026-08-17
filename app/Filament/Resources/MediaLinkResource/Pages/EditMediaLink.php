<?php

namespace App\Filament\Resources\MediaLinkResource\Pages;

use App\Filament\Resources\MediaLinkResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMediaLink extends EditRecord
{
    protected static string $resource = MediaLinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
