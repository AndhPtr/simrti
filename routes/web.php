<?php

use App\Http\Controllers\AsetKritisController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RiskController;
use App\Http\Controllers\MitigationController;
use App\Http\Controllers\KelemahanAsetsController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    // Use the resource route for users
    Route::resource('users', UserController::class); 
	Route::resource('risks', RiskController::class)->except(['show']);
    Route::get('/risks/evaluate', [RiskController::class, 'evaluate'])->name('risks.evaluate');
    Route::get('/risks/create_keterangan', [RiskController::class, 'createKeterangan'])->name('risks.create_keterangan');
    Route::get('/risks/{id}/edit_keterangan', [RiskController::class, 'editKeterangan'])->name('risks.edit_keterangan');
    Route::put('/risks/{id}', [RiskController::class, 'updateKeterangan'])->name('risks.update_keterangan');

    Route::resource('mitigations', MitigationController::class);
    Route::resource('asets', AsetKritisController::class);

    // Profile routes
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
    
    // Dynamic page routes
    Route::get('{page}', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index']);
});
