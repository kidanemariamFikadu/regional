<?php

use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');


    Route::get('/setting/user-list', action: \App\Livewire\Setting\UserList::class)->name('setting.user-list');
    Route::get('/setting/edit-user/{user}', action: \App\Livewire\Setting\EditUser::class)->name('setting.edit-user');
    Route::get('/setting/create-user', action: \App\Livewire\Setting\CreateUser::class)->name('setting.create-user');

    Route::get('/setting/regional-office-list', action: \App\Livewire\Setting\RegionalOfficeList::class)->name('setting.regional-office.list');
    Route::get('/setting/edit-regional-office/{regionalOffice}', action: \App\Livewire\Setting\EditRegionalOffice::class)->name('setting.edit-regional-office');
});

require __DIR__ . '/auth.php';
