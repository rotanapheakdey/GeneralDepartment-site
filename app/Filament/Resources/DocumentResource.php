<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentResource\Pages;
use App\Filament\Resources\DocumentResource\RelationManagers;
use App\Models\Document;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DocumentResource extends Resource
{
    protected static ?string $model = Document::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->label('ចំណងជើងឯកសារ (Title)'),

                Forms\Components\Select::make('document_type')
                    ->options([
                        'prakas' => 'ប្រកាស (Prakas)',
                        'sub_decree' => 'អនុក្រឹត្យ (Sub-decree)',
                        'notification' => 'សេចក្តីជូនដំណឹង (Notification)',
                    ])
                    ->required(),

                Forms\Components\FileUpload::make('file_path')
                    ->label('ឯកសារ PDF')
                    ->acceptedFileTypes(['application/pdf', 'application/x-pdf', 'application/acrobat', 'application/vnd.pdf', 'text/pdf', 'text/x-pdf'])
                    ->directory('documents') // Saves to storage/app/public/documents
                    ->preserveFilenames()
                    ->required(),

                Forms\Components\DatePicker::make('published_date')
                    ->default(now()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // This shows the title you typed
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                // This shows the type (Prakas, Decree, etc.)
                Tables\Columns\TextColumn::make('document_type') // Check this name!
                    ->badge()
                    ->label('Type')
                    ->color('primary'),

                // This shows the date it was added
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Uploaded At'),
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
        return [
            //
        ];
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
