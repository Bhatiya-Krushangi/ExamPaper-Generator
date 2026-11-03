<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('login');
})->name('loginpage');

// Route::get('/clear-cache', function() {
//     $exitCode = Artisan::call('cache:clear');
//     $exitCode = Artisan::call('config:cache');
//     return 'DONE'; //Return anything
// });

// Route::middleware([AuthCheck::class])->group(function () {

    Route::get('/register', [AuthController::class, 'registerpage'])->name('register');
    Route::post('/data_register', [AuthController::class, 'register'])->name('data.register');
    Route::get('/users', [AuthController::class, 'users'])->name('view.users');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/delete_user/{id}', [AuthController::class, 'delete_user'])->name('delete.user');
    Route::get('/edit_user/{id}', [AuthController::class, 'edit_user'])->name('edit.user');
    Route::get('/act_user/{id}',[AuthController::class,'act_user'])->name('act.user');

    //admin manage language
    Route::get('/lang', [AdminController::class, 'lang'])->name('view.lang');
    Route::get('/add_lang', [AdminController::class, 'add_lang'])->name('add.lang');
    Route::post('/store_lang', [AdminController::class, 'store_lang'])->name('store.lang');
    Route::get('/delete_lang/{id}', [AdminController::class, 'delete_lang'])->name('delete.lang');
    Route::get('/edit_lang/{id}', [AdminController::class, 'edit_lang'])->name('edit.lang');
    Route::get('/act_lang/{id}',[AdminController::class,'act_lang'])->name('act.lang');

    //admin manage topics
    Route::get('/topics', [AdminController::class, 'topics'])->name('view.topics');
    Route::get('/add_topic', [AdminController::class, 'add_topic'])->name('add.topic');
    Route::post('/store_topic', [AdminController::class, 'store_topic'])->name('store.topic');
    Route::get('/delete_topic/{id}', [AdminController::class, 'delete_topic'])->name('delete.topic');
    Route::get('/edit_topic/{id}', [AdminController::class, 'edit_topic'])->name('edit.topic');
    Route::get('/act_topic/{id}',[AdminController::class,'act_topic'])->name('act.topic');

    //manage Questions

    Route::any('/view_que', [UserController::class, 'view_que'])->name('view.que');
    Route::any('/view_questions', [UserController::class, 'view1_que'])->name('view1.que');
    Route::any('/show_que', [UserController::class, 'show_que'])->name('show.que');
    Route::get('/add_que', [UserController::class, 'add_que'])->name('add.que');
    Route::any('/get_topic', [UserController::class, 'get_topic'])->name('get.topic');
    Route::post('/store_que', [UserController::class, 'store_que'])->name('store.que');
    Route::any('/srch_que', [UserController::class, 'srch_que'])->name('srch.que');
    Route::any('/srch_questions', [UserController::class, 'srch1_que'])->name('srch1.que');
    Route::any('/delete_que', [UserController::class, 'delete_que'])->name('delete.que');
    Route::any('/act_que',[UserController::class,'act_que'])->name('act.que');
    Route::any('/edit_que', [UserController::class, 'edit_que'])->name('edit.que');
    Route::any('/update_que', [UserController::class, 'update_que'])->name('update.que');
    Route::any('/get_que', [UserController::class, 'get_que'])->name('get.que');
    Route::any('/final_que', [UserController::class, 'final_que'])->name('final.que');
    Route::any('/create_pdf', [UserController::class, 'create_pdf'])->name('create.pdf');
    Route::any('/get_marks', [UserController::class, 'get_marks'])->name('get.marks');



    //get type

    Route::any('/get_type', [UserController::class, 'get_type'])->name('get.type');
    Route::any('/chng_type', [UserController::class, 'chng_type'])->name('chng.type');

    //Recent paper
   Route::get('/recent_paper/{s_id?}', [TypeController::class, 'recent_paper'])->name('recent.paper');
    Route::get('/recent_papers', [TypeController::class, 'recent_papers'])->name('recent.papers');
    Route::get('/recent_paper', [TypeController::class, 'recent_paper1'])->name('recent.paper1');
    Route::any('get_id', [TypeController::class, 'get_id'])->name('get.id');

    //repeat view
    Route::get('repeat_view/{id}', [TypeController::class, 'repeat_view'])->name('repeat.view');
    Route::get('/edit_paper/{id}',[TypeController::class,'edit_paper'])->name('edit.paper');
// });
