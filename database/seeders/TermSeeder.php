<?php

namespace Database\Seeders;

use App\Models\TermsCondition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $term = [
            [
                'content' => 'Example Coral Hotel Terms and condition',
                'updated_at' => Now(),
                'created_at' => Now()
            ]
        ];

        TermsCondition::insert($term);
    }
}
