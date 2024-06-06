<?php

namespace Database\Seeders;

use App\Models\SmtpSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SmtpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $smtp = [
            [
                'mailer' => 'smtp',
                'host' => 'sandbox.smtp.mailtrap.io',
                'port' => '2525',
                'username' => 'c7e97c5b9b01ce',
                'password' => '4426671f6c25d9',
                'encryption' => 'tls',
                'from_address' => 'coralhotel@example.com',
                'updated_at' => Now(),
                'created_at' => Now()
            ]
        ];

        SmtpSetting::insert($smtp);
    }
}
