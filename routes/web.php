<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\FoldersController;
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

Route::get('/', function () {
    return redirect('/login');
});

// Route::get('/top', function () {return view('top');})->name('top');
Route::get('/top', [Controller::class, 'top'])->name('top');//完成？
// Route::post('/top', [Controller::class, 'top'])->name('top');//完成？
Route::post('/top', [Controller::class, 'Course_Name'])->name('Course_Name');//コース名登録後リターンリダイレクトでtopに送る

Route::post('/genre', [Controller::class, 'genre'])->name('genre');//コース名登録後リターンリダイレクトでtopに送る

Route::get('/genre_sort/{id}', [Controller::class, 'genre_sort'])->name('genre_sort');//非同期処理ジャンルソート

Route::post('/top_change', [Controller::class, 'top_change'])->name('top_change');//完成

Route::get('/top_create/{id}', [Controller::class, 'top_create'])->name('top_create');//完成？画面遷移あり
Route::get('/top_create', [Controller::class, 'top_cre'])->name('top_crea');//完成？画面遷移あり
Route::post('/top_create', [Controller::class, 'top_cre'])->name('top_cre');//完成？画面遷移あり

Route::get('/top_delete/{id}', [Controller::class, 'top_delete'])->name('top_delete');//完成

Route::get('/select_chapter/{id}', [Controller::class, 'select_chapter'])->name('select_chapter');//画面遷移あり?
// Route::get('/select_chapter_back/{id}', [Controller::class, 'select_chapter_back'])->name('select_chapter_back');//画面遷移あり?

Route::get('/chapter_Name/{id}', [Controller::class, 'chapter_Name'])->name('chapter_Name');//完成？
Route::post('/chapter_Name/{id}', [Controller::class, 'chapter_Name'])->name('chapter_Name');//完成？

Route::get('/Chapter_production/{id}', [Controller::class, 'Chapter_production'])->name('Chapter_production');//画面遷移あり

Route::post('/chap_pro', [Controller::class, 'chap_pro'])->name('chap_pro');//完成画面遷移あり

Route::get('/sele_chap_delete/{id}', [Controller::class, 'sele_chap_delete'])->name('sele_chap_delete');//完成

Route::get('/overview/{id}', [Controller::class, 'overview'])->name('overview');//完成

Route::post('/sele_change/{id}', [Controller::class, 'sele_change'])->name('sele_change');//完成

Route::get('/notice', [Controller::class, 'notice'])->name('notice');//完成

Route::post('/news_Name', [Controller::class, 'news_Name'])->name('news_Name');//完成

Route::get('/not_create/{id}', [Controller::class, 'not_create'])->name('not_create');//完成？画面遷移あり

Route::get('/not_delete/{id}', [Controller::class, 'not_delete'])->name('not_delete');//完成

Route::post('/not_change', [Controller::class, 'not_change'])->name('not_change');//完成

Route::post('/not_deep', [Controller::class, 'not_deep'])->name('not_deep');//完成画面遷移あり

Route::get('/favorite/{id}', [FavoritesController::class, 'favorite'])->name('favorite');//非同期処理良いね
// Route::post('/notice_detail', [Controller::class, 'notice_detail'])->name('notice_detail');//完成画面遷移あり

Route::get('/favorite_like', [FavoritesController::class, 'favorite_like'])->name('favorite_like');//完成画面遷移あり

Route::post('/folder_register', [FoldersController::class, 'folder_register'])->name('folder_register');//完成画面遷移あり

Route::post('/folder_lift', [FoldersController::class, 'folder_lift'])->name('folder_lift');//完成画面遷移あり

Route::post('/folder_delete', [FoldersController::class, 'folder_delete'])->name('folder_delete');//完成画面遷移あり

Route::post('/favorite_depths', [FavoritesController::class, 'favorite_depths'])->name('favorite_depths');//完成画面遷移あり

// Route::get('/folder_delete_dep', [FoldersController::class, 'folder_delete_dep'])->name('folder_delete_dep');//完成画面遷移あり
Route::post('/folder_delete_dep', [FoldersController::class, 'folder_delete_dep'])->name('folder_delete_dep');//完成画面遷移あり

Route::post('/folder_lift_dep', [FoldersController::class, 'folder_lift_dep'])->name('folder_lift_dep');//完成画面遷移あり



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
