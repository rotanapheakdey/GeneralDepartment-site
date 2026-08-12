<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LeaderResource\Pages;
use App\Filament\Resources\LeaderResource\RelationManagers;
use App\Models\Leader;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LeaderResource extends Resource
{
    protected static ?string $model = Leader::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    
    protected static ?string $navigationGroup = 'Content Management';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Leader Information')
                    ->schema([
                        Forms\Components\TextInput::make('name_en')
                            ->label('Name (English)')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('name_km')
                            ->label('Name (Khmer)')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('role')
                            ->options([
                                'minister' => 'Minister (រដ្ឋមន្រ្តី)',
                                'secretary_of_state' => 'Secretary of State (រដ្ឋលេខាធិការ)',
                                'under_secretary_of_state' => 'Under Secretary of State (អនុរដ្ឋលេខាធិការ)',
                            ])
                            ->required()
                            ->default('secretary_of_state'),
                        Forms\Components\TextInput::make('order')
                            ->label('Sort Order')
                            ->numeric()
                            ->default(0)
                            ->helperText('Lower numbers appear first'),
                    ])->columns(2),

                Forms\Components\Section::make('Portrait Image')
                    ->schema([
                        Forms\Components\SpatieMediaLibraryFileUpload::make('image')
                            ->collection('leader_images')
                            ->image()
                            ->maxSize(5120) // 5MB limit
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('image')
                    ->collection('leader_images')
                    ->circular(),
                Tables\Columns\TextColumn::make('name_km')
                    ->label('Name (Khmer)')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name_en')
                    ->label('Name (English)')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('role')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'minister' => 'Minister',
                        'secretary_of_state' => 'Secretary of State',
                        'under_secretary_of_state' => 'Under Secretary',
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'minister' => 'danger',
                        'secretary_of_state' => 'warning',
                        'under_secretary_of_state' => 'success',
                    }),
                Tables\Columns\TextColumn::make('order')
                    ->sortable(),
            ])
            ->defaultSort('order', 'asc')
            ->reorderable('order')
            ->filters([
                Tables\Filters\SelectFilter::make('role')
                    ->options([
                        'minister' => 'Minister',
                        'secretary_of_state' => 'Secretary of State',
                        'under_secretary_of_state' => 'Under Secretary',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageLeaders::route('/'),
        ];
    }
}
