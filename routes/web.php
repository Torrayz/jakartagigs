<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\HighlightController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminNewsController;
use App\Http\Controllers\Admin\AdminHighlightController;

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes - HARUS PALING ATAS DAN SPESIFIK!
Route::middleware(['auth', 'admin'])->group(function () {
    // Admin Dashboard
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
    
    // Admin News Management
    Route::get('/admin/news', [AdminNewsController::class, 'index'])->name('admin.news.index');
    Route::get('/admin/news/create', [AdminNewsController::class, 'create'])->name('admin.news.create');
    Route::post('/admin/news', [AdminNewsController::class, 'store'])->name('admin.news.store');
    Route::get('/admin/news/{news}/edit', [AdminNewsController::class, 'edit'])->name('admin.news.edit');
    Route::put('/admin/news/{news}', [AdminNewsController::class, 'update'])->name('admin.news.update');
    Route::delete('/admin/news/{news}', [AdminNewsController::class, 'destroy'])->name('admin.news.destroy');
    
    // Admin Highlights Management
    Route::get('/admin/highlights', [AdminHighlightController::class, 'index'])->name('admin.highlights.index');
    Route::get('/admin/highlights/create', [AdminHighlightController::class, 'create'])->name('admin.highlights.create');
    Route::post('/admin/highlights', [AdminHighlightController::class, 'store'])->name('admin.highlights.store');
    Route::get('/admin/highlights/{highlight}/edit', [AdminHighlightController::class, 'edit'])->name('admin.highlights.edit');
    Route::put('/admin/highlights/{highlight}', [AdminHighlightController::class, 'update'])->name('admin.highlights.update');
    Route::delete('/admin/highlights/{highlight}', [AdminHighlightController::class, 'destroy'])->name('admin.highlights.destroy');
});

// Public Routes - HARUS DI BAWAH ADMIN!
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [SearchController::class, 'index'])->name('search');

// Public News Routes
Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::get('/news/{news:slug}', [NewsController::class, 'show'])->name('news.show');

// Public Highlights Routes  
Route::get('/highlights', [HighlightController::class, 'index'])->name('highlights');
Route::get('/highlights/{highlight:slug}', [HighlightController::class, 'show'])->name('highlights.show');
