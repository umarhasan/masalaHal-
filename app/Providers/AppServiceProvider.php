<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Request;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\GeneralSetting;
use App\Models\LeadService;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $REQUEST)
    {
         // Share general data with all views
        $data['service_types'] = LeadService::all(); // <-- Footer/ServiceTypes
        // Share with all views
        View::share($data);

    }
}
