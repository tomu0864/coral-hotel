<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $site = [
            [
                'logo' => 'example',
                'phone' => '(+1) 123456789',
                'email' => 'coral@example.com',
                'address' => 'La Victoria Street, Lapu-Lapu, Cebu',
                'twitter' => 'example',
                'facebook' => 'example',
                'instagram' => 'example',
                'youtube' => 'example',
                'copyright' => 'Coral. All Rights Reserved.',
                'updated_at' => Now(),
                'created_at' => Now()
            ]
        ];

        SiteSetting::insert($site);
    }
}
