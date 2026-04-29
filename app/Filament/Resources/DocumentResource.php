<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentResource\Pages;
use App\Models\Document;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DocumentResource extends Resource
{
    protected static ?string $model = Document::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Title using translation key
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->label(__('portal.documents.title_column')),

                // Document Type Select using translation keys
                Forms\Components\Select::make('document_type')
                    ->options([
                        'prakas' => __('portal.documents.types.prakas'),
                        'sub_decree' => __('portal.documents.types.sub_decree'),
                        'notification' => __('portal.documents.types.notification'),
                        'directive' => __('portal.documents.types.directive'),
                    ])
                    ->required()
                    ->label(__('portal.documents.type_column')),

                Forms\Components\FileUpload::make('file_path')
                    ->label('ឯកសារ PDF')
                    ->acceptedFileTypes([
                        'application/pdf',
                        'application/x-pdf',
                        'application/acrobat',
                        'application/vnd.pdf',
                        'text/pdf',
                        'text/x-pdf'
                    ])
                    ->directory('documents')
                    ->required(),

                Forms\Components\DatePicker::make('published_date')
                    ->label(__('portal.documents.date_column'))
                    ->default(now()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('portal.documents.title_column'))
                    ->searchable()
                    ->sortable(),

                // Document Type Badge with Automatic Translation
                Tables\Columns\TextColumn::make('document_type')
                    ->badge()
                    ->label(__('portal.documents.type_column'))
                    ->color('primary')
                    // This line ensures 'prakas' becomes 'ប្រកាស' or 'Prakas'
                    ->formatStateUsing(fn(string $state): string => __("portal.documents.types.{$state}")),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label(__('Uploaded At')),

                // Audit Logs
                Tables\Columns\TextColumn::make('creator.name')
                    ->label('Uploaded By')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updater.name')
                    ->label('Last Modified By')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDocuments::route('/'),
            'create' => Pages\CreateDocument::route('/create'),
            'edit' => Pages\EditDocument::route('/{record}/edit'),
        ];
    }
}
