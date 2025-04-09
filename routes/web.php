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

    Route::get('/setting/job-description-list', action: \App\Livewire\Setting\JobDescriptionList::class)->name('setting.job-description.list');

    Route::get('/call-center/index', action: \App\Livewire\CallCenter\Index::class)->name('call-center.index');
    Route::get('/call-center/agent-management', action: \App\Livewire\Callcenter\AgentManagement::class)->name('call-center.agent-management');
    Route::get('/call-center/evaluation', action: \App\Livewire\CallCenter\Evaluation::class)->name('call-center.evaluation');
    Route::get('/call-center/evaluation-question/{question?}', action: \App\Livewire\CallCenter\EvaluationQuestion::class)->name('call-center.evaluation-question');
    Route::get('/call-center/manage-agent-audio', action: \App\Livewire\CallCenter\ManageAgentAudio::class)->name('call-center.manage-agent-audio');
    Route::get('/call-center/add-agent-audio/{agent_id?}', \App\Livewire\CallCenter\AddAgentAudio::class)->name('call-center.add-agent-audio');
    Route::get('/call-center/evaluate-agent-call/{agentEvaluationMonth}', action: \App\Livewire\CallCenter\EvaluateAgentCall::class)->name('call-center.evaluate-agent-call');
    Route::get('/call-center/agent_audio_report/', action: \App\Livewire\CallCenter\AgentAudioReport::class)->name('call-center.agent_audio_report');
});

require __DIR__ . '/auth.php';
