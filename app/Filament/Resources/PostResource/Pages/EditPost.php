<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPost extends EditRecord
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getFormActions(): array
    {
        return array_merge(parent::getFormActions(), [
            \Filament\Actions\Action::make('preview')
                ->label('Preview Post')
                ->color('secondary')
                ->icon('heroicon-m-eye')
                ->action(function () {})
                ->modalHeading('Post Preview')
                ->modalContent(fn () => view('filament.pages.post-preview', ['data' => $this->form->getState()]))
                ->modalSubmitAction(false)
                ->modalCancelAction(false)
        ]);
    }

}
