<?php

namespace App\Filament\Resources\DocumentResource\Pages;

use App\Filament\Resources\DocumentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDocument extends CreateRecord
{
    protected static string $resource = DocumentResource::class;

    // After creating a document, redirect back to a blank create form
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('create');
    }
}
