<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use App\Models\SiteSetting;

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
    public function boot(): void
    {
        // Register custom Blade directive for price formatting
        Blade::directive('price', function ($expression) {
            return "<?php echo App\Helpers\PriceHelper::formatVND($expression); ?>";
        });

        // Share site settings with all views
        View::composer('*', function ($view) {
            $siteSettings = SiteSetting::pluck('value', 'key')->toArray();
            $view->with('siteSettings', $siteSettings);
        });
    }
}
