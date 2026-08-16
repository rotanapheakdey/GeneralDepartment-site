<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActivityResource\Pages;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Database\Eloquent\Builder;

class ActivityResource extends Resource
{
    protected static ?string $model = Activity::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationGroup = 'Access Control';
    protected static ?string $modelLabel = 'Activity Log';
    protected static ?string $pluralModelLabel = 'Activity Logs';

    public static function canAccess(): bool
    {
        return auth()->user()->hasRole('admin');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Activity Details')
                    ->schema([
                        Forms\Components\TextInput::make('log_name')->disabled(),
                        Forms\Components\TextInput::make('description')->disabled(),
                        Forms\Components\TextInput::make('subject_type')->disabled(),
                        Forms\Components\TextInput::make('causer_type')->disabled(),
                        Forms\Components\TextInput::make('subject_identifier')
                            ->label('Subject Info')
                            ->formatStateUsing(fn ($record) => $record->subject ? ($record->subject->title ?? $record->subject->name ?? $record->subject->id) : '-')
                            ->disabled(),
                        Forms\Components\KeyValue::make('attribute_changes.old')
                            ->label('Old Values')
                            ->disabled()
                            ->columnSpanFull(),
                        Forms\Components\KeyValue::make('attribute_changes.attributes')
                            ->label('New Values')
                            ->disabled()
                            ->columnSpanFull(),
                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('log_name')
                    ->badge()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subject_type')
                    ->label('Subject Type')
                    ->searchable()
                    ->formatStateUsing(fn ($state) => class_basename($state)),
                Tables\Columns\TextColumn::make('subject_info')
                    ->label('Subject Info')
                    ->getStateUsing(fn ($record) => $record->subject ? ($record->subject->title ?? $record->subject->name ?? $record->subject->id) : '-'),
                Tables\Columns\TextColumn::make('causer.name')
                    ->label('User')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('edit_subject')
                    ->label('Edit Record')
                    ->icon('heroicon-o-pencil')
                    ->url(function ($record) {
                        if (!$record->subject) return null;
                        
                        $resource = match ($record->subject_type) {
                            \App\Models\Post::class => \App\Filament\Resources\PostResource::class,
                            \App\Models\Page::class => \App\Filament\Resources\PageResource::class,
                            \App\Models\Category::class => \App\Filament\Resources\CategoryResource::class,
                            \App\Models\User::class => \App\Filament\Resources\UserResource::class,
                            \App\Models\Leader::class => \App\Filament\Resources\LeaderResource::class,
                            \App\Models\Document::class => \App\Filament\Resources\DocumentResource::class,
                            \App\Models\Banner::class => \App\Filament\Resources\BannerResource::class,
                            default => null,
                        };
                        
                        if ($resource) {
                            return $resource::getUrl('edit', ['record' => $record->subject_id]);
                        }
                        
                        return null;
                    })
                    ->visible(fn ($record) => $record->subject !== null),
            ])
            ->bulkActions([
                //
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListActivities::route('/'),
            'view' => Pages\ViewActivity::route('/{record}'),
        ];
    }
}
