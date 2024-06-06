<?php

namespace App\Providers;

use App\Models\SmtpSetting;
use Illuminate\Support\Facades\Config as FacadesConfig;
use Illuminate\Support\Facades\Schema as FacadesSchema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */

    //  Change mail config from Admin Dashboard
    public function boot(): void
    {
        if (FacadesSchema::hasTable('smtp_settings')) {
            $smtpSetting = SmtpSetting::first();

            if ($smtpSetting) {
                $data = [
                    'driver' => $smtpSetting->mailer,
                    'host' => $smtpSetting->host,
                    'port' => $smtpSetting->port,
                    'username' => $smtpSetting->username,
                    'password' => $smtpSetting->password,
                    'encryption' => $smtpSetting->encryption,
                    'from' => [
                        'address' => $smtpSetting->from_address,
                        'name'    => 'Atoli Hotel'
                    ]
                ];
                FacadesConfig::set('mail', $data);
            }
        }
    }
}
