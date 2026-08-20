<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    // Optional: Changed icon to look more like 'Settings'
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationIconColor = 'warning';
    protected static ?string $navigationGroup = 'System Settings';
    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return false;
    }
    protected static ?string $navigationLabel = 'Site Settings';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Setting Details')
                ->description('Update the text or attach an image for this site setting.')
                ->schema([
                    Forms\Components\TextInput::make('key')
                        ->label('Setting Name')
                        ->formatStateUsing(fn ($state) => ucwords(str_replace('_', ' ', $state)))
                        ->disabled()
                        ->required(),

                    Forms\Components\Toggle::make('is_active_toggle')
                        ->label('Enable Breaking News')
                        ->visible(fn (callable $get, $record) => $record && $record->key === 'breaking_news_active')
                        ->helperText('Turn on to display the breaking news ticker on the website.'),

                    Forms\Components\Textarea::make('content_km_dummy')
                        ->label('Breaking News Content (Khmer)')
                        ->visible(fn (callable $get, $record) => $record && $record->key === 'breaking_news_active'),

                    Forms\Components\Textarea::make('content_en_dummy')
                        ->label('Breaking News Content (English)')
                        ->visible(fn (callable $get, $record) => $record && $record->key === 'breaking_news_active'),

                    Forms\Components\Textarea::make('value_km')
                        ->label('Value (Khmer)')
                        ->visible(fn (callable $get, $record) => !$record || $record->key !== 'breaking_news_active'),

                    Forms\Components\Textarea::make('value_en')
                        ->label('Value (English)')
                        ->visible(fn (callable $get, $record) => !$record || $record->key !== 'breaking_news_active'),

                    // NEW: The Image Uploader
                    SpatieMediaLibraryFileUpload::make('image')
                        ->collection('settings_media')
                        ->label('Attached Image (Optional)')
                        ->image()
                        ->imageEditor() // Gives admin ability to crop/rotate!
                        ->columnSpanFull(),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key')
                    ->label('Setting Name')
                    ->formatStateUsing(fn ($state) => ucwords(str_replace('_', ' ', $state)))
                    ->searchable()
                    ->sortable(),

                // NEW: Show a mini preview of the image in the table
                SpatieMediaLibraryImageColumn::make('image')
                    ->collection('settings_media')
                    ->label('Image/Logo')
                    ->circular(), // Makes the preview round and neat

                Tables\Columns\TextColumn::make('value_km')
                    ->limit(50)
                    ->label('Khmer')
                    ->formatStateUsing(fn ($state, $record) => $record->key === 'breaking_news_active' ? ($state === '1' ? 'Enabled' : 'Disabled') : $state)
                    ->color(fn ($state, $record) => $record->key === 'breaking_news_active' ? ($state === '1' ? 'success' : 'danger') : null)
                    ->badge(fn ($record) => $record->key === 'breaking_news_active'),

                Tables\Columns\TextColumn::make('value_en')
                    ->limit(50)
                    ->label('English'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([

            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()->where('key', '!=', 'breaking_news_content');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSettings::route('/'),
            // 'create' => Pages\CreateSetting::route('/create'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}
