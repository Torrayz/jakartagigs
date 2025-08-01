<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Music News', 'description' => 'Latest music industry news'],
            ['name' => 'Concert Reviews', 'description' => 'Concert and event reviews'],
            ['name' => 'Artist Interviews', 'description' => 'Exclusive artist interviews'],
            ['name' => 'Album Reviews', 'description' => 'New album reviews and ratings'],
            ['name' => 'Festival Coverage', 'description' => 'Music festival coverage'],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description']
            ]);
        }
    }
}
