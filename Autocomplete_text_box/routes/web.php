<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutocompleteController;
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

Route::get('/', [AutocompleteController::class ,'index']);

Route::get('/autocomplete/fetch', [AutocompleteController::class, 'fetch'])->name('autocomplete.fetch');

Route::post('/autocomplete/store', [AutocompleteController::class, 'store'])->name('autocomplete.store');
