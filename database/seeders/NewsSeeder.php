<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Str;

class NewsSeeder extends Seeder
{
    public function run()
    {
        $categories = Category::all();
        $admin = User::where('role', 'admin')->first();
        
        $newsData = [
            [
                'title' => 'Jakarta Music Festival 2024 Announces Lineup',
                'excerpt' => 'The biggest music festival in Indonesia reveals its star-studded lineup for 2024.',
                'content' => 'Jakarta Music Festival 2024 has officially announced its incredible lineup featuring both international and local artists. The festival, set to take place in March 2024, promises to be the biggest music event of the year. With headliners including world-renowned artists and rising Indonesian talents, this festival is not to be missed. The event will span three days and feature multiple stages showcasing different genres from pop and rock to electronic and traditional Indonesian music.',
                'featured_image' => 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=800&h=600&fit=crop',
                'is_featured' => true,
                'views' => rand(1000, 5000),
                'likes' => rand(50, 200)
            ],
            [
                'title' => 'Rising Indonesian Band Takes International Stage',
                'excerpt' => 'Local band makes waves in the international music scene with their latest album.',
                'content' => 'An Indonesian band has been making headlines internationally with their unique blend of traditional Indonesian music and modern rock. Their latest album has been praised by critics worldwide and has opened doors for more Indonesian artists to gain international recognition. The band\'s journey from playing in small Jakarta venues to international stages is truly inspiring and shows the potential of Indonesian music on the global stage.',
                'featured_image' => 'https://images.unsplash.com/photo-1511735111819-9a3f7709049c?w=800&h=600&fit=crop',
                'is_featured' => true,
                'views' => rand(800, 3000),
                'likes' => rand(30, 150)
            ],
            [
                'title' => 'New Music Venue Opens in South Jakarta',
                'excerpt' => 'A state-of-the-art music venue opens its doors, promising world-class acoustics.',
                'content' => 'South Jakarta welcomes a new addition to its music scene with the opening of a cutting-edge music venue. The venue boasts world-class acoustics, modern lighting systems, and a capacity for 2,000 music lovers. The opening night featured performances by some of Jakarta\'s most beloved artists, setting the tone for what promises to be an exciting addition to the city\'s entertainment landscape.',
                'featured_image' => 'https://images.unsplash.com/photo-1501386761578-eac5c94b800a?w=800&h=600&fit=crop',
                'is_featured' => false,
                'views' => rand(500, 2000),
                'likes' => rand(20, 100)
            ],
            [
                'title' => 'Interview: The Future of Indonesian Music',
                'excerpt' => 'Exclusive interview with industry leaders about the direction of Indonesian music.',
                'content' => 'In an exclusive interview, leading figures in the Indonesian music industry share their insights about the future of music in Indonesia. They discuss the impact of streaming platforms, the rise of independent artists, and how technology is changing the way music is created and consumed. The conversation reveals exciting developments and challenges facing the industry as it continues to evolve.',
                'featured_image' => 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=800&h=600&fit=crop',
                'is_featured' => false,
                'views' => rand(600, 2500),
                'likes' => rand(25, 120)
            ]
        ];

        foreach ($newsData as $data) {
            News::create([
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'excerpt' => $data['excerpt'],
                'content' => $data['content'],
                'featured_image' => $data['featured_image'],
                'category_id' => $categories->random()->id,
                'user_id' => $admin->id,
                'is_featured' => $data['is_featured'],
                'views' => $data['views'],
                'likes' => $data['likes'],
                'published_at' => now()->subDays(rand(1, 30))
            ]);
        }
    }
}
