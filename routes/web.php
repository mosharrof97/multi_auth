<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EditorController;
use App\Http\Controllers\StudentController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';






///////////////////////////////////////////////
Route::middleware('admin')->group(function (){
    Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin_dashboard');
    });

    Route::prefix('admin')->group(function (){
        Route::get('/login', [AdminController::class, 'login'])->name('admin_login');
        Route::get('/logout', [AdminController::class, 'logout'])->name('admin_logout');
        Route::post('/login-submit', [AdminController::class, 'login_submit'])->name('admin_login_submit');
        });


/////////////////////////////////////////////////////////////////
///////////////////////////////////////////////
Route::middleware('editor')->group(function (){
    Route::get('editor/dashboard', [EditorController::class, 'dashboard'])->name('editor_dashboard');
    });

    Route::prefix('editor')->group(function (){
        Route::get('/login', [EditorController::class, 'login'])->name('editor_login');
        Route::get('/logout', [EditorController::class, 'logout'])->name('editor_logout');
        Route::post('/login-submit', [EditorController::class, 'login_submit'])->name('editor_login_submit');
        });


/////////////////////////////////////////////////////////////////
///////////////////////////////////////////////
Route::middleware('student')->group(function (){
    Route::get('student/dashboard', [StudentController::class, 'dashboard'])->name('student_dashboard');
    });

    Route::prefix('student')->group(function (){
        Route::get('/login', [StudentController::class, 'login'])->name('student_login');
        Route::get('/logout', [StudentController::class, 'logout'])->name('student_logout');
        Route::post('/login-submit', [StudentController::class, 'login_submit'])->name('student_login_submit');
        });


/////////////////////////////////////////////////////////////////
