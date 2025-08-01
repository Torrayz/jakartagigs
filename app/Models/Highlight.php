<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Highlight extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'user_id',
        'views',
        'published_at'
    ];

    protected $casts = [
        'published_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopePublished($query)
    {
        return $query->where('published_at', '<=', now());
    }

    public function scopePopular($query)
    {
        return $query->orderBy('views', 'desc');
    }

    // FIXED: Proper image URL handling
    public function getImageUrlAttribute()
    {
        if ($this->featured_image) {
            return asset('storage/' . $this->featured_image);
        }
        return null; // Return null instead of placeholder
    }

    // Check if has uploaded image
    public function hasUploadedImage()
    {
        return !empty($this->featured_image) && file_exists(public_path('storage/' . $this->featured_image));
    }
}
