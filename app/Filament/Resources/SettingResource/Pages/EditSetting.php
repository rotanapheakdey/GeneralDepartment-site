<?php

namespace App\Filament\Resources\SettingResource\Pages;

use App\Filament\Resources\SettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSetting extends EditRecord
{
    protected static string $resource = SettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        if ($this->record->key === 'breaking_news_active') {
            $data['is_active_toggle'] = ($data['value_km'] === '1');
            $contentSetting = \App\Models\Setting::where('key', 'breaking_news_content')->first();
            $data['content_km_dummy'] = $contentSetting?->value_km;
            $data['content_en_dummy'] = $contentSetting?->value_en;
        }
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if ($this->record->key === 'breaking_news_active') {
            $val = !empty($data['is_active_toggle']) ? '1' : '0';
            $data['value_km'] = $val;
            $data['value_en'] = $val;
            
            \App\Models\Setting::updateOrCreate(
                ['key' => 'breaking_news_content'],
                [
                    'value_km' => $data['content_km_dummy'] ?? '',
                    'value_en' => $data['content_en_dummy'] ?? '',
                ]
            );
        }
        unset($data['is_active_toggle'], $data['content_km_dummy'], $data['content_en_dummy']);
        return $data;
    }
}
