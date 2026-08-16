<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';
    protected static ?string $navigationIconColor = 'primary';
    protected static ?string $navigationGroup = 'Content Management';
    protected static ?string $navigationLabel = 'Pages';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)->schema([
                    // Main Content Column (Spans 2 of 3)
                    Forms\Components\Grid::make(1)
                        ->columnSpan(2)
                        ->schema([
                            Forms\Components\Section::make('English Content')
                                ->schema([
                                    Forms\Components\TextInput::make('title_en')
                                        ->label('Title (English)')
                                        ->maxLength(255),
                                    Forms\Components\RichEditor::make('content_en')
                                        ->label('Content (English)')
                                        ->fileAttachmentsDisk('public')
                                        ->fileAttachmentsDirectory('pages'),
                                ]),
                            
                            Forms\Components\Section::make('Khmer Content')
                                ->schema([
                                    Forms\Components\TextInput::make('title_km')
                                        ->label('Title (Khmer)')
                                        ->maxLength(255),
                                    Forms\Components\RichEditor::make('content_km')
                                        ->label('Content (Khmer)')
                                        ->fileAttachmentsDisk('public')
                                        ->fileAttachmentsDirectory('pages'),
                                ])
                                ->collapsed(), // Collapsed by default for a cleaner UI

                            // Specialized Content Builders (Hidden by default based on Toggles)
                            Forms\Components\Section::make('Timeline & Leadership History')
                                ->visible(fn (Forms\Get $get) => $get('has_timeline'))
                                ->schema([
                                    Forms\Components\Repeater::make('timeline_data')
                                        ->label('Timeline Events')
                                        ->schema([
                                            Forms\Components\TextInput::make('year')
                                                ->required()
                                                ->label('Year/Period (e.g., 1993, 2023-Present)'),
                                            Forms\Components\Select::make('type')
                                                ->options([
                                                    'history' => 'Historical Event',
                                                    'leadership' => 'Leadership / Minister',
                                                ])
                                                ->required()
                                                ->default('history'),
                                            Forms\Components\TextInput::make('title_en')
                                                ->required()
                                                ->label('Title (English)'),
                                            Forms\Components\TextInput::make('title_km')
                                                ->required()
                                                ->label('Title (Khmer)'),
                                            Forms\Components\Textarea::make('description_en')
                                                ->label('Description (English)'),
                                            Forms\Components\Textarea::make('description_km')
                                                ->label('Description (Khmer)'),
                                            Forms\Components\FileUpload::make('image_path')
                                                ->label('Image (For Leadership)')
                                                ->disk('public')
                                                ->directory('timeline_images')
                                                ->image(),
                                        ])
                                        ->columns(2)
                                        ->collapsible()
                                        ->itemLabel(fn (array $state): ?string => $state['year'] ?? null),
                                ]),

                            Forms\Components\Section::make('Units Structure Builder')
                                ->visible(fn (Forms\Get $get) => $get('has_structure'))
                                ->schema([
                                    Forms\Components\Repeater::make('units_data')
                                        ->label('General Departments / Main Agencies')
                                        ->schema([
                                            Forms\Components\TextInput::make('name_en')
                                                ->required()
                                                ->label('Name (English)'),
                                            Forms\Components\TextInput::make('name_km')
                                                ->required()
                                                ->label('Name (Khmer)'),
                                            Forms\Components\Repeater::make('departments')
                                                ->label('Departments / Sub-units')
                                                ->schema([
                                                    Forms\Components\TextInput::make('name_en')
                                                        ->required()
                                                        ->label('Name (English)'),
                                                    Forms\Components\TextInput::make('name_km')
                                                        ->required()
                                                        ->label('Name (Khmer)'),
                                                ])
                                                ->columns(2)
                                                ->collapsible()
                                                ->itemLabel(fn (array $state): ?string => $state['name_en'] ?? null),
                                        ])
                                        ->columns(2)
                                        ->collapsible()
                                ]),

                            Forms\Components\Section::make('Leadership Portfolio Builder')
                                ->visible(fn (Forms\Get $get) => $get('has_portfolio'))
                                ->schema([
                                    Forms\Components\Repeater::make('portfolio_data')
                                        ->label('Portfolio Achievements')
                                        ->schema([
                                            Forms\Components\TextInput::make('year')
                                                ->required()
                                                ->label('Year/Date'),
                                            Forms\Components\TextInput::make('title_en')
                                                ->required()
                                                ->label('Title (English)'),
                                            Forms\Components\TextInput::make('title_km')
                                                ->required()
                                                ->label('Title (Khmer)'),
                                            Forms\Components\Textarea::make('description_en')
                                                ->label('Description (English)'),
                                            Forms\Components\Textarea::make('description_km')
                                                ->label('Description (Khmer)'),
                                        ])
                                        ->columns(2)
                                        ->collapsible()
                                        ->itemLabel(fn (array $state): ?string => $state['title_en'] ?? null),
                                ]),
                        ]),

                    // Sidebar Column (Spans 1 of 3)
                    Forms\Components\Grid::make(1)
                        ->columnSpan(1)
                        ->schema([
                            Forms\Components\Section::make('Page Settings')
                                ->schema([
                                    Forms\Components\TextInput::make('slug')
                                        ->required()
                                        ->unique(ignoreRecord: true)
                                        ->maxLength(255)
                                        ->helperText('The URL slug for this page (e.g. about-us)'),
                                ]),
                            
                            Forms\Components\Section::make('Page Features')
                                ->description('Enable specialized builders for this page.')
                                ->schema([
                                    Forms\Components\Toggle::make('has_timeline')
                                        ->label('Enable Timeline')
                                        ->dehydrated(false)
                                        ->live()
                                        ->afterStateHydrated(fn ($component, $state, $record) => $component->state(filled($record?->timeline_data))),
                                    
                                    Forms\Components\Toggle::make('has_structure')
                                        ->label('Enable Structure Builder')
                                        ->dehydrated(false)
                                        ->live()
                                        ->afterStateHydrated(fn ($component, $state, $record) => $component->state(filled($record?->units_data))),
                                    
                                    Forms\Components\Toggle::make('has_portfolio')
                                        ->label('Enable Portfolio Builder')
                                        ->dehydrated(false)
                                        ->live()
                                        ->afterStateHydrated(fn ($component, $state, $record) => $component->state(filled($record?->portfolio_data))),
                                ])
                        ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title_en')
                    ->label('Title (EN)')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title_km')
                    ->label('Title (KM)')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
