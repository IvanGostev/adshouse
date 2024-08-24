<?php

use App\Http\Controllers\AdsController;
use App\Http\Controllers\Advertiser\TariffAdvertiserController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\Moderator\CityModeratorController;
use App\Http\Controllers\Moderator\CountryModeratorController;
use App\Http\Controllers\Moderator\RegionModeratorController;
use App\Http\Controllers\Moderator\RoomTypeModeratorController;
use App\Http\Controllers\Moderator\StreetModeratorController;
use App\Http\Controllers\Moderator\TariffModeratorController;
use App\Http\Controllers\User\House\HouseUserController;


use App\Http\Controllers\User\House\RoomUserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
Route::get('/', function () {
    if (auth()->user()->role == 'moderator' ) {
        return redirect()->route('moderator.country.index');
    } else if (auth()->user()->role == 'user' ) {
        return redirect()->route('user.house.index');
    } else {
        return redirect()->route('advertiser.tariff.index');
    }
});
Route::prefix('user')->name('user.')->group(function () {
    Route::controller(HouseUserController::class)->prefix('houses')->name('house.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{house}/edit', 'edit')->name('edit');
        Route::patch('/{house}', 'update')->name('update');
        Route::delete('/{house}', 'destroy')->name('destroy');
    });
    Route::controller(RoomUserController::class)->prefix('rooms')->name('room.')->group(function () {
        Route::get('/{house}/', 'index')->name('index');
        Route::get('/{house}/create', 'create')->name('create');
        Route::post('/{house}/', 'store')->name('store');
        Route::get('/{room}/edit', 'edit')->name('edit');
        Route::patch('/{room}', 'update')->name('update');
        Route::delete('/{room}', 'destroy')->name('destroy');
    });


});
Route::prefix('advertiser')->name('advertiser.')->group(function () {
    Route::controller(TariffAdvertiserController::class)->prefix('tariffs')->name('tariff.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/my', 'my')->name('my');
        Route::post('/{tariff}', 'bye')->name('bye');
    });
});
Route::prefix('moderator')->name('moderator.')->group(function () {
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
    Route::controller(RegionModeratorController::class)
        ->prefix('regions')
        ->name('region.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/edit/{city}', 'edit')->name('edit');
            Route::patch('/{city}', 'update')->name('update');
            Route::delete('/{city}', 'destroy')->name('destroy');
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
    Route::controller(StreetModeratorController::class)
        ->prefix('streets')
        ->name('street.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/edit/{city}', 'edit')->name('edit');
            Route::patch('/{city}', 'update')->name('update');
            Route::delete('/{city}', 'destroy')->name('destroy');
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

});
});


Route::controller(BalanceController::class)->prefix('balance')->name('balance.')->group(function () {
        Route::get('/', 'show')->name('show');
        Route::post('/', 'handler')->name('handler');
});
Route::controller(AdsController::class)->prefix('ads')->name('ads.')->group(function () {
    Route::get('/{room}/{slug}', 'ads')->name('ads');
});
Auth::routes();
