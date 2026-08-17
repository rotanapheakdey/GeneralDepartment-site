<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            // Legal document metadata
            $table->string('reference_number')->nullable()->after('title')
                  ->comment('Official reference number e.g. ប្រ.ជ/003/2024');
            $table->string('issuing_authority')->nullable()->after('reference_number')
                  ->comment('e.g. General Department of Information & Broadcasting');
            $table->date('effective_date')->nullable()->after('published_date')
                  ->comment('When the decree/prakas becomes effective');
            $table->string('slug')->nullable()->unique()->after('title');
            $table->unsignedBigInteger('downloads_count')->default(0)->after('description');
            $table->boolean('is_featured')->default(false)->after('downloads_count');

            // Indexes
            $table->index('document_type');
            $table->index('published_date');
        });

        // Activate full-text search on documents
        Schema::table('documents', function (Blueprint $table) {
            $table->fullText(['title', 'description', 'reference_number']);
        });
    }

    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->dropFullText(['title', 'description', 'reference_number']);
            $table->dropIndex(['document_type']);
            $table->dropIndex(['published_date']);
            $table->dropColumn([
                'reference_number', 'issuing_authority', 'effective_date',
                'slug', 'downloads_count', 'is_featured',
            ]);
        });
    }
};
