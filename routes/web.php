<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScannerController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\DefiController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\BadgeController;
use App\Http\Controllers\StatistiqueController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AIController;

// Redirect root
Route::get('/', fn() => redirect()->route('login'));

// Auth
Route::get('/login',     [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',    [AuthController::class, 'login'])->name('login.post');
Route::get('/register',  [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout',   [AuthController::class, 'logout'])->name('logout');

// Authenticated routes
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Scanner
    Route::get('/scanner',             [ScannerController::class, 'index'])->name('scanner.index');
    Route::post('/scanner/scan',       [ScannerController::class, 'scan'])->name('scanner.scan');
    Route::get('/scanner/mobile/{token}', [ScannerController::class, 'mobileScanner'])->name('scanner.mobile');
    Route::get('/scanner/poll/{token}',    [ScannerController::class, 'pollCode'])->name('scanner.poll');
    Route::get('/scanner/result/{code}',   [ScannerController::class, 'result'])->name('scanner.result');
    Route::post('/scanner/send-code',  [ScannerController::class, 'sendCode'])->name('scanner.sendCode');

    // Produits
    Route::get('/produits',              [ProduitController::class, 'index'])->name('produits.index');
    Route::get('/produits/{codeBarres}', [ProduitController::class, 'show'])->name('produits.show');
    Route::post('/produits/analyser', [ProduitController::class, 'analyser'])->name('produits.analyser');

    // Defis
    Route::get('/defis',                    [DefiController::class, 'index'])->name('defis.index');
    Route::get('/defis/{id}',               [DefiController::class, 'show'])->name('defis.show');
    Route::post('/defis/{id}/participer',   [DefiController::class, 'participer'])->name('defis.participer');

    // Messages
    Route::get('/messages',              [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{userId}',     [MessageController::class, 'conversation'])->name('messages.conversation');
    Route::post('/messages/send',        [MessageController::class, 'send'])->name('messages.send');

    // Badges
    Route::get('/badges', [BadgeController::class, 'index'])->name('badges.index');

    // Stats
    Route::get('/stats', [StatistiqueController::class, 'index'])->name('stats.index');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/',                          [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/produits',                  [AdminController::class, 'produits'])->name('produits');
    Route::post('/produits',                 [AdminController::class, 'storeProduit'])->name('produits.store');
    Route::delete('/produits/{codeBarres}',  [AdminController::class, 'deleteProduit'])->name('produits.delete');
    Route::get('/defis',                     [AdminController::class, 'defis'])->name('defis');
    Route::post('/defis',                    [AdminController::class, 'storeDefi'])->name('defis.store');
    Route::get('/users',                     [AdminController::class, 'users'])->name('users');
    Route::delete('/users/{id}',             [AdminController::class, 'deleteUser'])->name('users.delete');
    Route::get('/badges',                    [AdminController::class, 'badges'])->name('badges');
    Route::post('/badges',                   [AdminController::class, 'storeBadge'])->name('badges.store');
});

// Routes IA
Route::middleware('auth')->prefix('ai')->name('ai.')->group(function () {
    Route::match(['get','post'], '/chatbot', [AIController::class, 'chatbot'])->name('chatbot');
    Route::get('/rapport', [AIController::class, 'rapport'])->name('rapport');
    Route::get('/defis', [AIController::class, 'defisPersonnalises'])->name('defis');
    Route::get('/empreinte', [AIController::class, 'empreinte'])->name('empreinte');
    Route::post('/analyser', [AIController::class, 'analyserProduit'])->name('analyser');
});

use App\Http\Controllers\AvisController;
Route::middleware('auth')->group(function () {
    Route::get('/avis', [AvisController::class, 'index'])->name('avis.index');
    Route::post('/avis', [AvisController::class, 'store'])->name('avis.store');
});
