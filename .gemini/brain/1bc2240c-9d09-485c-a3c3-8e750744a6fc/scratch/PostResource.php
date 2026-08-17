<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\DateTimePicker;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationIconColor = 'success';
    protected static ?string $navigationGroup = 'Content Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // === MAIN CONTENT ===
                Forms\Components\Section::make('Article Content')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->label('ចំណងជើងអត្ថបទ (Title)')
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($set, $state) => $set('slug', \Illuminate\Support\Str::slug($state))),

                        Forms\Components\TextInput::make('slug')
                            ->label('URL Slug')
                            ->unique(ignoreRecord: true)
                            ->prefix('news/')
                            ->helperText('Auto-generated from title. Edit only if needed.'),

                        Forms\Components\Select::make('category_id')
                            ->relationship('category', 'name')
                            ->preload()
                            ->searchable()
                            ->required()
                            ->label('News Category'),

                        Forms\Components\RichEditor::make('content')
                            ->required()
                            ->columnSpanFull()
                            ->label('ខ្លឹមសារអត្ថបទ (Content)'),
                    ])->columns(2),

                // === SEO & META ===
                Forms\Components\Section::make('SEO & Metadata')
                    ->description('Optimize how this article appears in search engines and when shared on social media.')
                    ->schema([
                        Forms\Components\TextInput::make('seo_title')
                            ->label('SEO Title')
                            ->maxLength(70)
                            ->placeholder('Leave empty to use article title')
                            ->helperText('Recommended: 50–70 characters'),

                        Forms\Components\Textarea::make('seo_description')
                            ->label('SEO / Meta Description')
                            ->maxLength(160)
                            ->rows(2)
                            ->placeholder('Short summary for search engines and social cards')
                            ->helperText('Recommended: 120–160 characters'),

                        Forms\Components\TextInput::make('source_credit')
                            ->label('Source Credit')
                            ->placeholder('e.g. AKP, TVK, Reporter Name')
                            ->helperText('Attribution for the news source'),
                    ])->columns(1)->collapsible(),

                // === EDITORIAL FLAGS ===
                Forms\Components\Section::make('Editorial Controls')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->options([
                                'draft'     => 'Draft',
                                'published' => 'Published',
                                'archived'  => 'Archived',
                            ])
                            ->required()
                            ->default('draft'),

                        DateTimePicker::make('published_at')
                            ->label('Publication Date')
                            ->default(now()),

                        DateTimePicker::make('scheduled_at')
                            ->label('Scheduled For')
                            ->helperText('Optional: auto-publish at this time'),

                        Forms\Components\Toggle::make('is_breaking')
                            ->label('🔴 Breaking News')
                            ->helperText('Displays a prominent breaking news badge'),

                        Forms\Components\Toggle::make('is_featured')
                            ->label('⭐ Featured Story')
                            ->helperText('Pin to the featured section of the homepage'),

                        Forms\Components\Toggle::make('is_pinned')
                            ->label('📌 Pinned')
                            ->helperText('Keep at the top of the news feed'),
                    ])->columns(3)->collapsible(),

                // === MEDIA ===
                Forms\Components\Section::make('Featured Image')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('featured_image_upload')
                            ->collection('featured_image')
                            ->label('Upload Image (Priority)')
                            ->image()
                            ->imageEditor()
                            ->helperText('If an image is uploaded here, it will be used instead of the external URL.'),

                        Forms\Components\TextInput::make('featured_image')
                            ->label('External Image URL (Fallback)')
                            ->url()
                            ->placeholder('https://example.com/image.jpg')
                            ->helperText('Used only if no image is uploaded above.'),
                    ])->columns(1)->collapsible(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('featured_image_url')
                    ->label('Image')
                    ->circular(),

                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->description(fn ($record) => $record->slug),

                Tables\Columns\IconColumn::make('is_breaking')
                    ->label('🔴')
                    ->boolean()
                    ->trueIcon('heroicon-s-fire')
                    ->trueColor('danger'),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label('⭐')
                    ->boolean()
                    ->trueIcon('heroicon-s-star')
                    ->trueColor('warning'),

                Tables\Columns\TextColumn::make('category.name')
                    ->badge(),

                Tables\Columns\TextColumn::make('views_count')
                    ->label('Views')
                    ->sortable()
                    ->numeric()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'published' => 'success',
                        'draft' => 'warning',
                        'archived' => 'danger',
                    }),

                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('creator.name')
                    ->label('Created By')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updater.name')
                    ->label('Last Edited By')
                    ->sortable(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\Action::make('preview')
                    ->icon('heroicon-o-eye')
                    ->color('secondary')
                    ->modalHeading('Post Preview')
                    ->modalContent(fn ($record) => view('filament.pages.post-preview', ['data' => $record->toArray()]))
                    ->modalSubmitAction(false)
                    ->modalCancelAction(false),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Delete Selected')
                        ->requiresConfirmation()
                        ->deselectRecordsAfterCompletion(),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->hasAnyRole(['admin', 'editor']);
    }

    public static function canDeleteAny(): bool
    {
        return auth()->user()->hasRole('admin');
    }
}
