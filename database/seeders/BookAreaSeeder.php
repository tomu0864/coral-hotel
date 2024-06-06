<?php

namespace Database\Seeders;

use App\Models\BookArea;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $book_area = [
            [
                'image' => 'example',
                'subtitle' => 'MAKE A QUICK BOOKING',
                'main_title' => 'We Are the Best in All-time & So Please Get a Quick Booking',
                'short_desc' => "Coral is one of the best resorts in the global market and that's why you will get a luxury life period on the global market. We always provide you a special support for all of our guests and that's will be the main reason to be the most popular.",
                'link_url' => 'example',
                'updated_at' => Now(),
                'created_at' => Now()
            ]
        ];

        BookArea::insert($book_area);
    }
}
