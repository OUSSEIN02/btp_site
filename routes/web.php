<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GlassController;
use App\Http\Controllers\SettingsController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/auth', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');

Route::post('/auth', [App\Http\Controllers\AuthController::class, 'login'])->name('login.submit');


Route::get('/lunettes', [App\Http\Controllers\LunettesController::class, 'index'])->name('lunettes.index');

Route::get('/initiatives', [App\Http\Controllers\InitiativesController::class, 'index'])->name('initiatives.index');

Route::get('/apropos', [App\Http\Controllers\AproposController::class, 'index'])->name('apropos.index');

Route::get('/rdv', [App\Http\Controllers\RdvController::class, 'index'])->name('rdv.index');

Route::post('/rendez-vous', [AppointmentController::class, 'store'])->name('appointment.store');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


// Admin routes protégées par auth middleware

Route::middleware('auth')->group(function () {


    Route::get('/admin',[App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/rendezvous', [App\Http\Controllers\AdminController::class, 'rendezvous'])->name('admin.rendezvous');
    Route::get('/admin/messages', [App\Http\Controllers\AdminController::class, 'messages'])->name('admin.messages');
    Route::get('/admin/lunettes', [App\Http\Controllers\AdminController::class, 'lunettes'])->name('admin.lunettes');
    

    Route::prefix('admin')->group(function () {
        Route::get('glasses', [GlassController::class, 'index'])->name('admin.glasses');
        Route::post('glasses', [GlassController::class, 'store']);
        Route::get('glasses/{id}/edit', [GlassController::class, 'edit']);
        Route::put('glasses/{id}', [GlassController::class, 'update']);
        Route::patch('glasses/{id}/toggle', [GlassController::class, 'toggleStatus']);
        Route::delete('glasses/{id}', [GlassController::class, 'destroy']);
    });

    Route::prefix('admin')->middleware(['auth'])->group(function () {
        Route::get('/appointments', [AppointmentController::class, 'index'])->name('admin.appointments');
        Route::get('/appointments/{id}', [AppointmentController::class, 'show']);
        Route::patch('/appointments/{id}/status', [AppointmentController::class, 'updateStatus']);
        Route::delete('/appointments/{id}', [AppointmentController::class, 'destroy']);
    });


    Route::prefix('admin')->group(function () {
        Route::get('/messages/dashbord', [ContactController::class, 'adminindex'])->name('admin.messages.dashboard');
        Route::patch('/messages/{id}/read', [ContactController::class, 'markAsRead']);
        Route::delete('/messages/{id}', [ContactController::class, 'destroy']);
    });

    Route::prefix('admin')->group(function () {
        Route::get('/settings', [SettingsController::class, 'index'])->name('admin.settings');
        Route::put('/settings/profile', [SettingsController::class, 'updateProfile'])->name('admin.settings.profile');
        Route::put('/settings/password', [SettingsController::class, 'updatePassword'])->name('admin.settings.password');
        Route::put('/settings/contact', [SettingsController::class, 'updateContact'])->name('admin.settings.contact');
        Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('admin.logout');
    });

});



