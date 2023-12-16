<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [AuthController::class, 'login'])->name('login');



Route::get('/logout', [AuthController::class, 'logout'])->name('get.logout');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/getKabupaten/{provinsi_id}', [AuthController::class, 'getKabupaten']);

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store'])->name('store');
});

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::middleware('admin')->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('/', [AdminController::class, 'index'])->name('admin');
            Route::get('/index', [AdminController::class, 'index'])->name('admin');
            Route::resource('mahasiswa', AdminController::class)->parameters([
                'mahasiswa' => 'mahasiswa'
            ]);
            Route::prefix('mahasiswa')->group(function () {
                Route::put('/{mahasiswa}/verify', [AdminController::class, 'verify'])->name('mahasiswa.verify');
            });
            Route::resource('user', AdminUserController::class);
            Route::prefix('user')->group(function () {
                Route::put('/{user}/verify', [AdminUserController::class, 'verify'])->name('user.verify');
            });
        });
    });
    Route::middleware('mahasiswa')->group(function () {
        Route::prefix('mahasiswa')->group(function () {
            Route::get('/', [MahasiswaController::class, 'index'])->name('mahasiswa');
            Route::get('/index', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
            Route::put('/{mahasiswa}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
        });
    });
});
