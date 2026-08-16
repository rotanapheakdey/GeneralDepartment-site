<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Actions\Action;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Filament\Notifications\Notification;

class SystemBackup extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-archive-box';
    protected static string $view = 'filament.pages.system-backup';
    protected static ?string $navigationGroup = 'System Settings';
    protected static ?string $title = 'System Backup';

    public static function canAccess(): bool
    {
        return auth()->user()->hasRole('admin');
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('generate_backup')
                ->label('Generate & Download Backup (ZIP)')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('primary')
                ->action(function () {
                    try {
                        // Run the backup command
                        Artisan::call('backup:run');
                        
                        // Find the latest backup file
                        $disk = config('backup.backup.destination.disks')[0];
                        $backupName = config('backup.backup.name');
                        $files = Storage::disk($disk)->files($backupName);
                        
                        if (empty($files)) {
                            Notification::make()
                                ->title('Backup Failed')
                                ->body('No backup file was generated.')
                                ->danger()
                                ->send();
                            return;
                        }

                        // Get the most recent file
                        $latestBackup = collect($files)->sortByDesc(function ($file) use ($disk) {
                            return Storage::disk($disk)->lastModified($file);
                        })->first();

                        Notification::make()
                            ->title('Backup Successful')
                            ->body('Your download will begin shortly.')
                            ->success()
                            ->send();

                        return response()->download(Storage::disk($disk)->path($latestBackup));

                    } catch (\Exception $e) {
                        Notification::make()
                            ->title('Backup Failed')
                            ->body($e->getMessage())
                            ->danger()
                            ->send();
                    }
                })
                ->requiresConfirmation()
                ->modalHeading('Generate System Backup')
                ->modalDescription('This will create a full ZIP backup of your database and all uploaded files. This may take a moment. Are you sure you want to proceed?'),
        ];
    }
}
