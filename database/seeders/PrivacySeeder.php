<?php

namespace Database\Seeders;

use App\Models\PrivacyPolicy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrivacySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $privacy = [
            [
                'content' => 'example',
                'updated_at' => Now(),
                'created_at' => Now()
            ]
        ];

        PrivacyPolicy::insert($privacy);
    }
}
