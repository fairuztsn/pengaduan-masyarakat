<?php

use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TanggapanController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Controller;
use App\Http\Middleware\OnlyAdmin;
use App\Http\Middleware\OnlyUser;
use App\Models\Laporan;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix("/u")->group(function() {
        Route::get("/", [LaporanController::class, "dashboard"])->name("dashboard");

        Route::prefix("laporan")->group(function() {
            Route::get("/", [LaporanController::class, "index"])->name("laporan.index");
            
            Route::post("/store", [LaporanController::class, "store"])->name("laporan.store")->middleware([OnlyUser::class]);
            Route::get("/history", [LaporanController::class, "history"])->name("laporan.history");
            Route::get("/{id}", [LaporanController::class, "detail"])->name("laporan.detail");

            Route::get("/{id}/edit", [LaporanController::class, "edit"])->name("laporan.edit");
            Route::post("/{id}/update", [LaporanController::class, "update"])->name("laporan.update");
            Route::post("/{id}/delete", [LaporanController::class, "destroy"])->name("laporan.delete");

            Route::post("{id}/{method}", [LaporanController::class, "set"])->name("laporan.set");
        });

        Route::prefix("tanggapan")->group(function() {
            Route::get("/", [TanggapanController::class, "index"])->name("tanggapan.index");
            Route::post("/store", [TanggapanController::class, "store"])->name("tanggapan.store");

            Route::post("{id}/delete", [TanggapanController::class, "destroy"])->name("tanggapan.delete");
        })->middleware([OnlyAdmin::class]);

    });
    
    Route::get("/search", [Controller::class, "search"])->name("search")->middleware([OnlyAdmin::class]);

    // Route::middleware("onlyuser")->group(function() {
        
    // });

    // Route::middleware("onlyadmin")->group(function() {
    //     Route::prefix("a")->group(function() {
    //         Route::get("/", [\App\Http\Controllers\Admin\LaporanController::class, "index"])->name("admin.index");
    //     });
    // });
});

Route::get("/test", function() {
    return view("index", [
        "value" => Laporan::all()
    ]);
});

require __DIR__.'/auth.php';

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
