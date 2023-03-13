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
use App\Http\Controllers\SettingsController;

// Middlewares
use App\Http\Middleware\OnlyAdmin;
use App\Http\Middleware\OnlyUser;
use App\Models\Tanggapan;

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
        Route::post("/{id}/archive", [LaporanController::class, "archive"])->name("laporan.archive")->middleware([OnlyAdmin::class]);
        Route::get("/history", [LaporanController::class, "history"])->name("laporan.history");

        Route::get("/{id}", [LaporanController::class, "detail"])->name("laporan.detail");
        Route::post("/{id}", [LaporanController::class, "update"])->name("laporan.update");
        Route::post("/{id}", [LaporanController::class, "destroy"])->name("laporan.delete");

        Route::post("/set", [LaporanController::class, "set"])->name("laporan.set");
    });

    Route::middleware("onlyadmin")->group( function() {
        Route::prefix("tanggapan")->group(function() {
            Route::get("/", [TanggapanController::class, "index"])->name("tanggapan.index");
            Route::post("/store", [TanggapanController::class, "store"])->name("tanggapan.store");
            Route::get("/{id}", [TanggapanController::class, "detail"])->name("tanggapan.detail");
            Route::post("/{id}/delete", [TanggapanController::class, "destroy"])->name("tanggapan.delete");
            Route::post("/{id}/archive", [TanggapanController::class, "archive"])->name("tanggapan.archive");
        });

        Route::prefix("archive")->group( function() {
            Route::get("/", function() {return view("archive.index");})->name("archived.index");

            Route::prefix("laporan")->group(function() {
                Route::get("/", [ArchivedController::class, "laporan"])->name("archived.laporan");
                Route::get("/{id}", [LaporanController::class, "archived"])->name("archived.laporan.detail");
                Route::post("/{id}/unarchive", [LaporanController::class, "unarchive"])->name("laporan.unarchive");
            });

            Route::prefix("tanggapan")->group(function() {
                Route::get("/", [ArchivedController::class, "tanggapan"])->name("archived.tanggapan");
                Route::get("/{id}", [TanggapanController::class, "archived"])->name("archived.tanggapan.detail");
                Route::post("{id}/unarchive", [TanggapanController::class, "unarchive"])->name("tanggapan.unarchive");
            });
        });
    });

    Route::middleware("onlyone")->group(function() {
        Route::prefix("user")->group(function() {
            Route::get("/", [UserController::class, "index"])->name("user.index");
            Route::get("/create", [UserController::class, "create"])->name("user.create");
            Route::post("/store", [UserController::class, "store"])->name("user.store");
            Route::get("/{id}", [UserController::class, "profile"])->name("user.profile");
        });
    });

    Route::prefix("settings")->group(function() {
        Route::get("/", [SettingsController::class, "index"])->name("settings.index");
        Route::get("/profile", [SettingsController::class, "profile"])->name("settings.profile");
        Route::get("/profile/change-password", [SettingsController::class, "changePassword"])->name("settings.profile.change-password");

        Route::post("/profile/update", [SettingsController::class, "updateProfile"])->name("settings.profile.update");
        Route::post("/validate-old-password", [SettingsController::class, "validateOldPassword"])->name("settings.profile.validate-old-password");
    });
});

Route::get("/test", [Controller::class, "test"]);

require __DIR__.'/auth.php';

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
