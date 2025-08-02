<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('meta_title')->nullable();
            $table->text('excerpt');
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->longText('content');
            $table->integer('reading_time')->nullable()->comment('Reading time in minutes');
            $table->string('featured_image')->nullable();
            $table->json('tags')->nullable()->comment('Article tags as JSON array');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('views')->default(0);
            $table->integer('likes')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->enum('status', ['draft', 'published', 'archived'])->default('published');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes untuk performance
            $table->index(['published_at', 'is_featured']);
            $table->index(['views']);
            $table->index(['status', 'published_at']);
            $table->index(['user_id', 'published_at']);
            $table->index(['created_at']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('news');
    }
};
