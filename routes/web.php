<?php

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

Route::get('/', 'Index@loadIndex')->middleware('auth')->name('index');
Route::get('/login', 'Login@loadLogin')->name('login');
Route::post('/doLogin', 'Login@authenticate')->name('doLogin');
Route::get('logout', 'Login@logout')->name('logout');
Route::get('noticiasAgenda', 'NoticiasAgenda@loadNoticiasAgenda')->middleware('auth')->name('noticiasAgenda');
