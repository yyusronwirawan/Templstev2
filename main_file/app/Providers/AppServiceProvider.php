<?php

namespace App\Providers;

use App\Models\settings;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use PhpOffice\PhpSpreadsheet\Writer\Ods\Settings as OdsSettings;
use Stancl\Tenancy\Contracts\Domain;

class AppServiceProvider extends ServiceProvider
{
    /**
     * 
     * 
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Guard $auth)
    {
    }
}
