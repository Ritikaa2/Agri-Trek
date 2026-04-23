<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FarmerController;
use App\Http\Controllers\LandController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contact', function() {
    return view('contact');
});
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'submit'])->name('contact.submit');

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return view('admin.dashboard');
    }
    return view('farmer.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Farmer specific routes
    Route::get('/farmer/kyc', [FarmerController::class, 'create'])->name('farmer.kyc.create');
    Route::post('/farmer/kyc', [FarmerController::class, 'store'])->name('farmer.kyc.store');
    
    Route::get('/farmer/lands/create', [LandController::class, 'create'])->name('farmer.lands.create');
    Route::post('/farmer/lands', [LandController::class, 'store'])->name('farmer.lands.store');
    Route::get('/farmer/lands', [LandController::class, 'index'])->name('farmer.lands.index');
    
    // Advanced Farmer Features
    Route::get('/farmer/mandi', [App\Http\Controllers\MandiController::class, 'index'])->name('farmer.mandi.index');
    Route::get('/farmer/weather', [App\Http\Controllers\WeatherController::class, 'index'])->name('farmer.weather.index');
    Route::get('/farmer/ai', [App\Http\Controllers\AiAgentController::class, 'index'])->name('farmer.ai.index');
    Route::post('/farmer/ai/chat', [App\Http\Controllers\AiAgentController::class, 'chat'])->name('farmer.ai.chat');
    Route::get('/farmer/schemes', [App\Http\Controllers\SchemeController::class, 'index'])->name('farmer.schemes.index');
    Route::post('/farmer/schemes/{scheme}/apply', [App\Http\Controllers\SchemeController::class, 'apply'])->name('farmer.schemes.apply');
    Route::get('/farmer/applications', [App\Http\Controllers\SchemeController::class, 'myApplications'])->name('farmer.applications.index');

    // Admin specific routes
    Route::get('/admin/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/aerial', [App\Http\Controllers\AerialDatasetController::class, 'create'])->name('admin.aerial.create');
    Route::post('/admin/aerial', [App\Http\Controllers\AerialDatasetController::class, 'store'])->name('admin.aerial.store');
});

require __DIR__.'/auth.php';
