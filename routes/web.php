<?php

use App\Http\Controllers\AdsController;
use App\Http\Controllers\Advertiser\MainAdvertiserController;
use App\Http\Controllers\Advertiser\TariffAdvertiserController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\Moderator\BalanceModeratorController;
use App\Http\Controllers\Moderator\CityModeratorController;
use App\Http\Controllers\Moderator\CountryModeratorController;
use App\Http\Controllers\Moderator\DistrictModeratorController;
use App\Http\Controllers\Moderator\HouseModeratorController;
use App\Http\Controllers\Moderator\LinkModeratorController;
use App\Http\Controllers\Moderator\QrcodeModeratorController;
use App\Http\Controllers\Moderator\RoomModeratorController;
use App\Http\Controllers\Moderator\RoomTypeModeratorController;
use App\Http\Controllers\Moderator\TariffModeratorController;
use App\Http\Controllers\Moderator\UserModeratorController;
use App\Http\Controllers\Owner\House\HouseOwnerController;
use App\Http\Controllers\Owner\House\RoomOwnerController;
use App\Http\Controllers\Owner\LinkOwnerController;
use App\Http\Controllers\Owner\MainOwnerController;
use App\Http\Controllers\User\MainUserController;
use App\Http\Middleware\AdvertiserMiddleware;
use App\Http\Middleware\ClientMiddleware;
use App\Http\Middleware\ModeratorMiddleware;
use App\Http\Middleware\OwnerMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    return redirect()->route('roles');
})->name('home');

Route::controller(LoginController::class)->group(function () {
    Route::get('admin-login', 'showAdminLoginForm');
});

Route::controller(ForgotPasswordController::class)->group(function () {
    Route::get('/admin-password/reset', 'showAdminLinkRequestForm')->name('admin.password.reset');
});

Route::controller(VerificationController::class)->group(function () {
    Route::get('/email/verify', 'notice')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', 'verify')->name('verification.verify');
    Route::post('/email/resend', 'resend')->name('verification.resend');
});


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::patch('/change-role', [App\Http\Controllers\RoleManagerController::class, 'change'])->name('change-role');

Route::middleware('auth')->group(function () {
    Route::get('/roles', function () {
        if (auth()->user()->role == 'moderator' or auth()->user()->role == 'admin') {
            return redirect()->route('moderator.house.index');
        } else if (auth()->user()->role == 'owner') {
            return redirect()->route('owner.main.index');
        } else if (auth()->user()->role == 'advertiser') {
            return redirect()->route('advertiser.main.index');
        }  else if (auth()->user()->role == 'user') {
            return redirect()->route('user.main.index');
        }
    })->name('roles');


    Route::middleware('verified')->group(function () {
        Route::prefix('owner')->name('owner.')->middleware(OwnerMiddleware::class)->group(function () {
            Route::controller(MainOwnerController::class)->name('main.')->group(function () {
                Route::get('/', 'index')->name('index');
            });
            Route::controller(HouseOwnerController::class)->prefix('houses')->name('house.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::get('/{house}/edit', 'edit')->name('edit');
                Route::patch('/{house}', 'update')->name('update');
                Route::delete('/{house}', 'delete')->name('destroy');
            });
            Route::controller(RoomOwnerController::class)->prefix('rooms')->name('room.')->group(function () {
                Route::get('/{house}/', 'index')->name('index');
                Route::get('/{house}/create', 'create')->name('create');
                Route::post('/{house}/', 'store')->name('store');
                Route::get('/{room}/edit', 'edit')->name('edit');
                Route::patch('/{room}', 'update')->name('update');
                Route::delete('/{room}', 'delete')->name('destroy');
            });
            Route::controller(LinkOwnerController::class)->prefix('links')->name('link.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{link}/statistic', 'statistic')->name('statistic');
            });

        });
        Route::prefix('user')->name('user.')->middleware(ClientMiddleware::class)->group(function () {
            Route::controller(MainUserController::class)->name('main.')->group(function () {
                Route::get('/', 'index')->name('index');
            });
        });
        Route::prefix('advertiser')->name('advertiser.')->middleware(AdvertiserMiddleware::class)->group(function () {
            Route::controller(MainAdvertiserController::class)->name('main.')->group(function () {
                Route::get('/', 'index')->name('index');
            });
            Route::controller(TariffAdvertiserController::class)->prefix('tariffs')->name('tariff.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/my', 'my')->name('my');
                Route::get('/{UT}/statistics', 'show')->name('show');
                Route::post('/{tariff}', 'bye')->name('bye');
            });
        });
        Route::prefix('moderator')->name('moderator.')->middleware(ModeratorMiddleware::class)->group(function () {
            Route::controller(UserModeratorController::class)
                ->prefix('users')
                ->name('user.')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/{user}/history', 'history')->name('history');
                    Route::get('/{user}/tariffs', 'tariffs')->name('tariffs');
                    Route::get('/{user}/houses', 'houses')->name('houses');
                    Route::get('/{house}/rooms', 'rooms')->name('rooms');
                    Route::get('/create', 'create')->name('create');
                    Route::post('/', 'store')->name('store');
                    Route::delete('/{user}', 'destroy')->name('destroy');
                });
            Route::controller(CountryModeratorController::class)
                ->prefix('countries')
                ->name('country.')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/create', 'create')->name('create');
                    Route::post('/', 'store')->name('store');
                    Route::get('/edit/{country}', 'edit')->name('edit');
                    Route::patch('/{country}', 'update')->name('update');
                    Route::delete('/{country}', 'destroy')->name('destroy');
                });
            Route::controller(CityModeratorController::class)
                ->prefix('cities')
                ->name('city.')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/create', 'create')->name('create');
                    Route::post('/', 'store')->name('store');
                    Route::get('/edit/{city}', 'edit')->name('edit');
                    Route::patch('/{city}', 'update')->name('update');
                    Route::delete('/{city}', 'destroy')->name('destroy');
                });
            Route::controller(DistrictModeratorController::class)
                ->prefix('districts')
                ->name('district.')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/create', 'create')->name('create');
                    Route::post('/', 'store')->name('store');
                    Route::get('/edit/{district}', 'edit')->name('edit');
                    Route::patch('/{district}', 'update')->name('update');
                    Route::delete('/{district}', 'destroy')->name('destroy');
                });
            Route::controller(RoomTypeModeratorController::class)
                ->prefix('room-types')
                ->name('room-type.')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/create', 'create')->name('create');
                    Route::post('/', 'store')->name('store');
                    Route::get('/edit/{type}', 'edit')->name('edit');
                    Route::patch('/{type}', 'update')->name('update');
                    Route::delete('/{type}', 'destroy')->name('destroy');
                });
            Route::controller(TariffModeratorController::class)->prefix('tariffs')->name('tariff.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::get('/{tariff}/edit', 'edit')->name('edit');
                Route::patch('/{tariff}', 'update')->name('update');
                Route::delete('/{tariff}', 'destroy')->name('destroy');
            });
            Route::controller(BalanceModeratorController::class)->prefix('balance')->name('balance.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::patch('/{application}', 'update')->name('update');
            });
            Route::controller(HouseModeratorController::class)->prefix('houses')->name('house.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/search', 'search')->name('search');
                Route::patch('/{house}', 'update')->name('update');
            });
            Route::controller(RoomModeratorController::class)->prefix('rooms')->name('room.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/search', 'search')->name('search');
                Route::patch('/{room}', 'update')->name('update');
            });
            Route::controller(LinkModeratorController::class)->prefix('links')->name('link.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{link}/statistic', 'statistic')->name('statistic');
                Route::patch('/{link}/approve', 'approve')->name('approve');
                Route::patch('/{link}/refund', 'refund')->name('refund');
            });
            Route::controller(QrcodeModeratorController::class)->prefix('qrcodes')->name('qrcode.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{qrcode}/statistic', 'statistic')->name('statistic');
                Route::get('/{qrcode}/edit', 'edit')->name('edit');
                Route::get('/{qrcode}/search', 'search')->name('search');
                Route::post('/', 'store')->name('store');
                Route::patch('/{qrcode}/update', 'update')->name('update');
                Route::patch('/{qrcode}/free', 'free')->name('free');
                Route::delete('/{qrcode}', 'destroy')->name('destroy');
            });
        });
    });
});


Route::controller(BalanceController::class)->prefix('balance')->name('balance.')->group(function () {
    Route::get('/', 'show')->name('show');
    Route::post('/', 'handler')->name('handler');
});
Route::controller(AdsController::class)->prefix('ads')->group(function () {
    Route::get('/{room}/{slug}/room', 'ads')->name('ads');
    Route::get('/{qrcode}/qrcode', 'qrcode')->name('qrcode');
});

Auth::routes();
