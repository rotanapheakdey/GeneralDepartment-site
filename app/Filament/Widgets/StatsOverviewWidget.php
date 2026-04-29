<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\Post;
use App\Models\Document;
use App\Models\User;
use App\Models\Category;

class StatsOverviewWidget extends BaseWidget
{
    protected function getCards(): array
    {
        $postCount = Post::count();
        $newPosts = Post::where('created_at', '>=', now()->subWeek())->count();
        $documentCount = Document::count();
        $userCount = User::count();
        $categoryCount = Category::count();

        return [
            Card::make('Posts', $postCount)
                ->description("{$newPosts} new this week")
                ->descriptionIcon($newPosts > 0 ? 'heroicon-o-arrow-trending-up' : 'heroicon-o-arrow-trending-down')
                ->color('primary')
                ->icon('heroicon-o-newspaper')
                ->url(route('filament.admin.resources.posts.index'), true),

            Card::make('Documents', $documentCount)
                ->description('Official PDFs')
                ->icon('heroicon-o-document-text')
                ->color('success')
                ->url(route('filament.admin.resources.documents.index'), true),

            Card::make('Users', $userCount)
                ->description('Admins & staff')
                ->icon('heroicon-o-users')
                ->color('warning')
                ->url(route('filament.admin.resources.users.index'), true),

            Card::make('Categories', $categoryCount)
                ->description('Content groups')
                ->icon('heroicon-o-tag')
                ->color('info')
                ->url(route('filament.admin.resources.categories.index'), true),
        ];
    }
}
