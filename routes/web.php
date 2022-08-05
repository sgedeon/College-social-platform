<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\BlogPostController;

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

Route::get('/',[CustomAuthController::class, 'index'])->name('login');

Route::get('lang/{locale}', [LocalizationController::class, 'index'])->name('lang');

Route::middleware('admin')->group(function () {
    Route::get('etudiant-create', [EtudiantController::class, 'create'])->name('etudiant.create')->middleware('auth');
    Route::post('etudiant-create', [EtudiantController::class, 'store'])->name('etudiant.store')->middleware('auth');
    Route::delete('etudiants/{etudiant}', [EtudiantController::class, 'destroy'])->name('etudiant.update')->middleware('auth');
});

Route::get('etudiants', [EtudiantController::class, 'index'])->name('etudiants')->middleware('auth');
Route::get('etudiants/{etudiant}', [EtudiantController::class, 'show'])->name('etudiant.show')->middleware('auth');
Route::get('etudiant-edit/{etudiant}', [EtudiantController::class, 'edit'])->name('etudiant.edit')->middleware('auth');
Route::put('etudiant-edit/{etudiant}', [EtudiantController::class, 'update'])->name('etudiant.update')->middleware('auth');

Route::get('blog', [BlogPostController::class, 'index'])->name('blog')->middleware('auth');
Route::get('blog/{blogPost}', [BlogPostController::class, 'show'])->name('blog.show')->middleware('auth');
Route::get('blog-create', [BlogPostController::class, 'create'])->name('blog.create')->middleware('auth');
Route::post('blog-create', [BlogPostController::class, 'store'])->name('blog.create.post')->middleware('auth');
Route::get('blog-edit/{blogPost}', [BlogPostController::class, 'edit'])->name('blog.edit')->middleware('auth');
Route::put('blog-edit/{blogPost}', [BlogPostController::class, 'update'])->name('blog.update')->middleware('auth');
Route::delete('blog/{blogPost}', [BlogPostController::class, 'destroy'])->name('blog.delete')->middleware('auth');

Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('custom.login');
Route::get('registration', [CustomAuthController::class, 'create'])->name('registration');
Route::post('custom-registration', [CustomAuthController::class, 'store'])->name('custom.registration');
Route::get('dashboard', [CustomAuthController::class, 'dashboard'])->name('dashboard');
Route::get('logout', [CustomAuthController::class, 'logout'])->name('logout')->middleware('auth');


