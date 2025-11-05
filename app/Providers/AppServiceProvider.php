<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Crypt;

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
    public function boot()
    {
        Blade::directive('appName', function () {
            return "<?php echo config('app.name'); ?>";
        });

        // App::setLocale(Session::get('locale', config('app.locale')));
        view()->composer('*', function () {
            if (Auth::guard('customer')->check()) {
                App::setLocale(Auth::guard('customer')->user()->language ?? 'en');
            } else {
                App::setLocale(Session::get('locale', 'en'));
            }
        });



        Schema::defaultStringLength(191);

        Paginator::useBootstrap();

        // Share activeCategoryId with all views (robust logic)
        View::composer('*', function ($view) {
            $activeCategoryId = null;

            try {
                $route = Route::current();
                $params = $route ? $route->parameters() : [];

                // Try common parameter keys (adjust if your route param name differs)
                $possibleKeys = ['category_id', 'category', 'id', 'encrypted_id', 'cid'];

                foreach ($possibleKeys as $key) {
                    if (isset($params[$key]) && !empty($params[$key])) {
                        $value = $params[$key];

                        // If it's a model (Route Model Binding) get its id
                        if (is_object($value) && isset($value->id)) {
                            $activeCategoryId = $value->id;
                            break;
                        }

                        // If numeric already
                        if (is_numeric($value)) {
                            $activeCategoryId = (int) $value;
                            break;
                        }

                        // Try modern decrypt first
                        try {
                            $dec = Crypt::decryptString($value);
                            if (is_numeric($dec)) {
                                $activeCategoryId = (int) $dec;
                                break;
                            }

                            // if decryptString returned serialized data
                            if (is_string($dec) && preg_match('/^([aOsibdN]):/', $dec)) {
                                $maybe = @unserialize($dec);
                                if ($maybe !== false || $dec === 'b:0;') {
                                    $activeCategoryId = is_numeric($maybe) ? (int)$maybe : $maybe;
                                    break;
                                }
                            }
                        } catch (\Throwable $e) {
                            // try older decrypt()
                            try {
                                $dec2 = Crypt::decrypt($value);
                                if (is_numeric($dec2)) {
                                    $activeCategoryId = (int) $dec2;
                                    break;
                                }
                                if (is_string($dec2) && preg_match('/^([aOsibdN]):/', $dec2)) {
                                    $maybe2 = @unserialize($dec2);
                                    if ($maybe2 !== false || $dec2 === 'b:0;') {
                                        $activeCategoryId = is_numeric($maybe2) ? (int)$maybe2 : $maybe2;
                                        break;
                                    }
                                }
                            } catch (\Throwable $e2) {
                                // not decryptable — continue loop
                            }
                        }
                    }
                }

                // Fallback: try last URL segment
                if (!$activeCategoryId) {
                    $segments = Request::segments();
                    if (!empty($segments)) {
                        $last = end($segments);

                        // numeric last segment
                        if (is_numeric($last)) {
                            $activeCategoryId = (int)$last;
                        } else {
                            // try decryptString/decrypt on last segment
                            try {
                                $dec = Crypt::decryptString($last);
                                if (is_numeric($dec)) $activeCategoryId = (int)$dec;
                                else if (is_string($dec) && preg_match('/^([aOsibdN]):/', $dec)) {
                                    $maybe = @unserialize($dec);
                                    if ($maybe !== false || $dec === 'b:0;') {
                                        $activeCategoryId = is_numeric($maybe) ? (int)$maybe : $maybe;
                                    }
                                }
                            } catch (\Throwable $e) {
                                try {
                                    $dec2 = Crypt::decrypt($last);
                                    if (is_numeric($dec2)) $activeCategoryId = (int)$dec2;
                                    else if (is_string($dec2) && preg_match('/^([aOsibdN]):/', $dec2)) {
                                        $maybe2 = @unserialize($dec2);
                                        if ($maybe2 !== false || $dec2 === 'b:0;') {
                                            $activeCategoryId = is_numeric($maybe2) ? (int)$maybe2 : $maybe2;
                                        }
                                    }
                                } catch (\Throwable $e2) {
                                    // give up
                                }
                            }
                        }
                    }
                }
            } catch (\Throwable $e) {
                // swallow — leave null
                $activeCategoryId = null;
            }

            // Final normalization: if serialized string like "i:1;" unserialize it
            if (is_string($activeCategoryId) && preg_match('/^([aOsibdN]):/', $activeCategoryId)) {
                $unser = @unserialize($activeCategoryId);
                if ($unser !== false || $activeCategoryId === 'b:0;') {
                    $activeCategoryId = $unser;
                }
            }

            // Cast numeric-like to int
            if (is_numeric($activeCategoryId)) {
                $activeCategoryId = (int) $activeCategoryId;
            }

            // Share with all views
            $view->with('activeCategoryId', $activeCategoryId);
        });
    }

}
