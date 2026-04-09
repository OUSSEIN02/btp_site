<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashbordController;
use App\Http\Controllers\RealisationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CompanySettingController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;


Route::get('/',[HomeController::class, 'index'])->name('home');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');


Route::post('/login', [AuthController::class, 'login']
)->name('login.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/realisations', [HomeController::class, 'realisations'])->name('realisations');
Route::get('/presentations', [HomeController::class, 'presentations'])->name('presentations');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

Route::get('/realisations/{id}', [HomeController::class, 'show'])->name('realisations.show');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store'); ;



Route::middleware('auth')->group(function () {
  
    Route::get('/dashboard', function () {
        return view('layouts.admin');
    })->name('panelAdmin');



    Route::get('/admin/dashboard', [DashbordController ::class, 'index'])
        ->name('dashboard');


    // Route::prefix('/admin/membres')->name('members.')->group(function () {
        
    //     Route::get('/', [MembreController::class, 'index'])->name('index');
    //     Route::get('/create', [MembreController::class, 'create'])->name('create');
    //     Route::post('/', [MembreController::class, 'store'])->name('store');
        
    //     Route::get('/{id}/edit', [MembreController::class, 'edit'])->name('edit');
    //     Route::put('/{id}', [MembreController::class, 'update'])->name('update');
    //     Route::delete('/{id}', [MembreController::class, 'destroy'])->name('destroy');
    // });

    // // Actualites routes
    Route::prefix('/admin/realisations')->name('realisations.')->group(function () {

        
        Route::get('/', [RealisationController::class, 'index'])->name('index');
        Route::get('/create', [RealisationController::class, 'create'])->name('create');
        Route::post('/', [RealisationController::class, 'store'])->name('store');
        
        Route::get('/{reals}/edit', [RealisationController::class, 'edit'])->name('edit'); 
        Route::put('/{reals}', [RealisationController::class, 'update'])->name('update');   
        Route::delete('/{reals}', [RealisationController::class, 'destroy'])->name('destroy');
        
    });

    Route::prefix('/admin/messages')->name('messages.')->group(function () {

        Route::get('/', [App\Http\Controllers\MessageController::class, 'index'])
            ->name('index');
    
        Route::get('/{message}', [App\Http\Controllers\MessageController::class, 'show'])
            ->name('show');
    
        Route::delete('/{message}', [App\Http\Controllers\MessageController::class, 'destroy'])
            ->name('destroy');

        Route::patch('/{message}/read', [App\Http\Controllers\MessageController::class, 'markAsRead'])
            ->name('markAsRead');
             
    });


    Route::get('/admin/services', [ServiceController::class, 'index'])->name('admin.services.index');
Route::post('/admin/services', [ServiceController::class, 'store'])->name('admin.services.store');
Route::delete('/admin/services/{id}', [ServiceController::class, 'destroy'])->name('admin.services.destroy');
    

  

    
});


Route::middleware(['auth'])->prefix('admin/settings')->group(function () {


    Route::get('/index', [CompanySettingController::class, 'index'])
        ->name('settings.index');

    Route::get('/', [CompanySettingController::class, 'edit'])
        ->name('admin.settings.edit');

    Route::put('/about', [CompanySettingController::class, 'updateAbout'])
        ->name('admin.settings.update.about');

    Route::put('/services', [CompanySettingController::class, 'updateServices'])
        ->name('admin.settings.update.services');

    Route::put('/contact', [CompanySettingController::class, 'updateContact'])
        ->name('admin.settings.update.contact');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/company', [CompanySettingController::class, 'edit'])
        ->name('admin.settings.edit');

    Route::post('/admin/company', [CompanySettingController::class, 'update'])
        ->name('admin.settings.update');
});


Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');