<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('posts', function (Blueprint $table) {
        $table->uuid('id')->primary();
        // Use foreignUuid because your Category model uses HasUuids
        $table->foreignUuid('category_id')->nullable()->constrained()->onDelete('cascade');

        $table->string('title');
        $table->longText('content');
        $table->text('excerpt')->nullable();

        // ADD THIS LINE:
        $table->string('featured_image')->nullable();

        $table->timestamp('published_at')->nullable();
        $table->enum('status', ['draft', 'published', 'archived'])->default('published'); // Changed default to published for testing
        $table->json('meta_data')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
