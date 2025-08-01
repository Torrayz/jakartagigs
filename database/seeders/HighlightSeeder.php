<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Highlight;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Str;

class HighlightSeeder extends Seeder
{
    public function run()
    {
        $categories = Category::all();
        $admin = User::where('role', 'admin')->first();
        
        $highlightsData = [
            [
                'title' => 'Top 10 Indonesian Artists to Watch in 2024',
                'excerpt' => 'Discover the rising stars of Indonesian music scene.',
                'content' => 'The Indonesian music scene is buzzing with fresh talent and innovative sounds. From indie rock bands to electronic music producers, these 10 artists are set to make waves in 2024. Each brings a unique perspective and sound that reflects the diversity and creativity of Indonesian music today.',
                'featured_image' => 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=800&h=600&fit=crop',
                'views' => rand(2000, 8000),
                'likes' => rand(100, 400)
            ],
            [
                'title' => 'Best Concert Venues in Jakarta',
                'excerpt' => 'A guide to the most iconic music venues in the capital.',
                'content' => 'Jakarta offers a diverse range of concert venues, from intimate jazz clubs to massive outdoor amphitheaters. This comprehensive guide explores the best places to catch live music in the city, including their unique characteristics, capacity, and the types of performances they typically host.',
                'featured_image' => 'https://images.unsplash.com/photo-1501386761578-eac5c94b800a?w=800&h=600&fit=crop',
                'views' => rand(1500, 6000),
                'likes' => rand(80, 300)
            ],
            [
                'title' => 'The Evolution of Indonesian Pop Music',
                'excerpt' => 'How Indonesian pop has transformed over the decades.',
                'content' => 'Indonesian pop music has undergone significant transformation since the 1970s. From the golden age of dangdut to the modern fusion of traditional and contemporary sounds, this article traces the evolution of Indonesian pop and its impact on Southeast Asian music culture.',
                'featured_image' => 'https://images.unsplash.com/photo-1511735111819-9a3f7709049c?w=800&h=600&fit=crop',
                'views' => rand(1800, 7000),
                'likes' => rand(90, 350)
            ]
        ];

        foreach ($highlightsData as $data) {
            Highlight::create([
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'excerpt' => $data['excerpt'],
                'content' => $data['content'],
                'featured_image' => $data['featured_image'],
                'category_id' => $categories->random()->id,
                'user_id' => $admin->id,
                'views' => $data['views'],
                'likes' => $data['likes'],
                'published_at' => now()->subDays(rand(1, 60))
            ]);
        }
    }
}
