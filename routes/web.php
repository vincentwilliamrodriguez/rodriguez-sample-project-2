<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
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
});

require __DIR__.'/auth.php';

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    Route::middleware(['auth'])->group(function() {
        // Route::get('/tasks', [TaskController::class, 'index'])
        //     ->name('tasks.index');

        // Route::get('/tasks/create', [TaskController::class, 'create'])
        //     ->name('tasks.create');

        // Route::post('/tasks', [TaskController::class, 'store'])
        //     ->name('tasks.store');

        // Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])
        //     ->name('tasks.edit');

        // Route::put('/tasks/{task}', [TaskController::class, 'update'])
        //     ->name('tasks.update');

        // Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])
        //     ->name('tasks.destroy');

        Route::resource('tasks', TaskController::class);

        Route::get('/tasks/{task}', [TaskController::class, 'show'])
            ->name('tasks.show');

        Route::middleware('role:admin')->group(function() {
            Route::resource('users', UserController::class);
        });
    });

});



