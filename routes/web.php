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

    
    Route::get('/setting',action: \App\Livewire\Setting\Index::class)->name('setting.index');
    Route::get('/setting/edit-user/{user}',action: \App\Livewire\Setting\EditUser::class)->name('setting.edit-user');
});

require __DIR__.'/auth.php';
