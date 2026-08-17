<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // SEO & URL
            $table->string('slug')->nullable()->unique()->after('title');
            $table->string('seo_title', 70)->nullable()->after('excerpt');
            $table->string('seo_description', 160)->nullable()->after('seo_title');

            // Editorial flags
            $table->boolean('is_breaking')->default(false)->after('status');
            $table->boolean('is_featured')->default(false)->after('is_breaking');
            $table->boolean('is_pinned')->default(false)->after('is_featured');

            // Content metadata
            $table->unsignedSmallInteger('read_time')->nullable()->after('content')->comment('Estimated reading time in minutes');
            $table->string('source_credit')->nullable()->after('read_time')->comment('AKP, TVK, Reporter name, etc.');

            // Analytics
            $table->unsignedBigInteger('views_count')->default(0)->after('source_credit');

            // Extended workflow
            $table->enum('workflow_status', ['draft', 'in_review', 'editor_approved', 'scheduled', 'published', 'archived'])
                  ->default('draft')
                  ->after('is_pinned');
            $table->timestamp('scheduled_at')->nullable()->after('published_at');

            // Indexes for performance
            $table->index(['status', 'published_at']);
            $table->index(['is_breaking']);
            $table->index(['is_featured']);
            $table->index('slug');
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropIndex(['status', 'published_at']);
            $table->dropIndex(['is_breaking']);
            $table->dropIndex(['is_featured']);
            $table->dropIndex('posts_slug_index');
            $table->dropColumn([
                'slug', 'seo_title', 'seo_description',
                'is_breaking', 'is_featured', 'is_pinned',
                'read_time', 'source_credit', 'views_count',
                'workflow_status', 'scheduled_at',
            ]);
        });
    }
};
