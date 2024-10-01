<?php

namespace App\Providers;

use App\Actions\Fortify\SCreateNewSecurityDepartmentOffice;
use App\Actions\Fortify\SCreateNewTourismOffice;
use App\Actions\Fortify\SCreateNewTouristPolice;
use App\Actions\Fortify\SResetUserPassword;
use App\Actions\Fortify\SUpdateUserPassword;
use App\Actions\Fortify\SUpdateUserProfileInformation;

use App\Actions\Fortify\HotelUser\CreateNewHotelOwner;
use App\Actions\Fortify\HotelUser\ResetUserPassword;
use App\Actions\Fortify\HotelUser\UpdateUserPassword;
use App\Actions\Fortify\HotelUser\UpdateUserProfileInformation;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\RegisterResponse;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $request = request();
        if ($request->is('t-p/*')) {
            Config::set('fortify.guard', 'tourist_police');
            Config::set('fortify.passwords', 'polices');
            Config::set('fortify.prefix', 't-p');
        } elseif ($request->is('t-o/*')) {
            Config::set('fortify.guard', 'tourism_office');
            Config::set('fortify.passwords', 'offices');
            Config::set('fortify.prefix', 't-o');
        } elseif ($request->is('s-d-o/*')) {
            Config::set('fortify.guard', 'security_department_office');
            Config::set('fortify.passwords', 'securities');
            Config::set('fortify.prefix', 's-d-o');
        } elseif ($request->is('hotel/*')) {
            Config::set('fortify.guard', 'web');
            Config::set('fortify.passwords', 'hotels');
            Config::set('fortify.prefix', 'hotel');
        } else {
            Config::set('fortify.guard', 'web');
            Config::set('fortify.passwords', 'hotels');
        }

        $this->app->instance(LoginResponse::class, new class implements LoginResponse
        {
            public function toResponse($request)
            {
                if ($request->user('tourism_office')) {
                    return redirect()->intended('t-o/dashboard');
                } elseif ($request->user('tourist_police')) {
                    return redirect()->intended('t-p/dashboard');
                } elseif ($request->user('security_department_office')) {
                    return redirect()->intended('s-d-o/dashboard');
                }elseif ($request->user('web')) {
                    return redirect()->intended('hotel/dashboard');
                }
            }
        });

        $this->app->instance(RegisterResponse::class, new class implements RegisterResponse
        {
            public function toResponse($request)
            {
                $user = Auth::user();
                // if(empty($user->id)){
                //     return redirect()->back();
                // }
                $hotel = $user->user_of_hotel->hotels->last();
                $id = $hotel->id;
                return redirect()->route('instanc', $id);
            }
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        $request = request();
        $user_type = Config::get('fortify.guard');

        if ($user_type == 'security_department_office' || $user_type == 'tourism_office' || $user_type == 'tourist_police') {
            if ($user_type == 'security_department_office') {
                Fortify::createUsersUsing(SCreateNewSecurityDepartmentOffice::class);
            } elseif ($user_type == 'tourism_office') {
                Fortify::createUsersUsing(SCreateNewTourismOffice::class);
            } else {
                Fortify::createUsersUsing(SCreateNewTouristPolice::class);
            }

            Fortify::updateUserProfileInformationUsing(SUpdateUserProfileInformation::class);
            Fortify::updateUserPasswordsUsing(SUpdateUserPassword::class);
            Fortify::resetUserPasswordsUsing(SResetUserPassword::class);
            Fortify::viewPrefix('auth.');
        } else {
            
            Fortify::createUsersUsing(CreateNewHotelOwner::class);
            Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
            Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
            Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
            Fortify::viewPrefix('hotels.auth.');
        }
    }
}
