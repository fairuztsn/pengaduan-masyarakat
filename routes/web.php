<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Controllers
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TanggapanController;
use App\Http\Controllers\ArchivedController;

// Middlewares
use App\Http\Middleware\OnlyAdmin;
use App\Http\Middleware\OnlyUser;

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get("/", [LaporanController::class, "dashboard"])->name("dashboard");

    Route::prefix("laporan")->group(function() {
        Route::get("/", [LaporanController::class, "index"])->name("laporan.index");
        
        Route::post("/store", [LaporanController::class, "store"])->name("laporan.store")->middleware([OnlyUser::class]);
        Route::get("/history", [LaporanController::class, "history"])->name("laporan.history");
        Route::get("/{id}", [LaporanController::class, "detail"])->name("laporan.detail");

        Route::post("/{id}/update", [LaporanController::class, "update"])->name("laporan.update");
        Route::post("/{id}/delete", [LaporanController::class, "destroy"])->name("laporan.delete");

        Route::post("/archive", [LaporanController::class, "archive"])->name("laporan.archive")->middleware([OnlyAdmin::class]);
        Route::post("/set", [LaporanController::class, "set"])->name("laporan.set");
    });

    Route::middleware("onlyadmin")->group( function() {
        Route::prefix("tanggapan")->group( function() {
            Route::get("/", [TanggapanController::class, "index"])->name("tanggapan.index");
            Route::post("/store", [TanggapanController::class, "store"])->name("tanggapan.store");
            Route::post("{id}/delete", [TanggapanController::class, "destroy"])->name("tanggapan.delete");
        });

        Route::prefix("archive")->group( function() {
            Route::get("/", function() {return view("archive.index");})->name("archived.index");

            Route::prefix("laporan")->group(function() {
                Route::get("/", [ArchivedController::class, "laporan"])->name("archived.laporan");
                Route::get("/{id}", [LaporanController::class, "archived"])->name("archived.laporan.detail");
                Route::post("/unarchive", [LaporanController::class, "unarchive"])->name("laporan.unarchive");
            });
        });

        Route::prefix("user")->group( function() {
            Route::get("/", [UserController::class, "index"])->name("user.index");
            Route::get("/{id}", [UserController::class, "profile"])->name("user.profile");
        });
    });
});

Route::get("/test", [Controller::class, "test"]);

require __DIR__.'/auth.php';

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
