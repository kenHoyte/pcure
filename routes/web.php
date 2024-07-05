<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestsController;
use App\Models\Req;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/backend/layouts/main', function () {
    $reqs=Req::all();
    return view('backend.pages.requests', compact('reqs'));
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('backend/main', function () {
//     // $reqs=Req::all();
//     return view('backend.layout.maincontent', compact('reqs'));
// })->middleware(['auth', 'verified'])->name('main');

Route::get('requests', [PageController::class, 'requests'])->name('requests');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::post('/addRequest', [RequestsController::class, 'addRequest'])->name('addRequest');
});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
