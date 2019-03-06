<?php

namespace App\Providers;

use App\Models\Gmail;
use App\Models\LogActivities;
use App\Models\Ticket;
use App\Observers\TicketObserver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        Schema::defaultStringLength(191);

        Paginator::defaultView('pagination::view');

        Paginator::defaultSimpleView('pagination::view');


        \Blade::directive('ok', function ($expression) {
            return "<?php if(userCan($expression)): ?>";
        });

        \Blade::directive('endok', function ($expression) {
            return '<?php endif; ?>';
        });

        \Blade::directive('hasAccess', function ($expression) {
            return "<?php if(hasAccess($expression)): ?>";
        });

        \Blade::directive('endHasAccess', function ($expression) {
            return '<?php endif; ?>';
        });
        \Blade::directive('convert', function ($money) {
            return "<?php echo number_format($money, 2); ?>";
        });
        Ticket::observe(TicketObserver::class);
        if(Gmail::isAccessTokenExpired()){
            $freshToken=Gmail::refreshToken(null);
            $old=Gmail::config()?Gmail::config():[];
            $token=array_merge($old,$freshToken);
            if(!\File::isDirectory(storage_path('app'.DS.'gmail'))){
                \File::makeDirectory(storage_path('app'.DS.'gmail'));
            }
            if(!\File::isDirectory(storage_path('app'.DS.'gmail'.DS.'tokens'))){
                \File::makeDirectory(storage_path('app'.DS.'gmail'.DS.'tokens'));
            }
            \File::put(storage_path('app'.DS.'gmail'.DS.'tokens'.DS.'gmail-json.json'),json_encode($token,true));
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
