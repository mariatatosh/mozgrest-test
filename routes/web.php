<?php

use App\Http\Controllers;
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

Route::redirect('/', '/ru');

Route::get('/{lang}', Controllers\DictionaryController::class)->name('dictionary');
Route::get('/{lang}/api', Controllers\SearchController::class)->name('search');
