<?php

use App\Http\Controllers\ContactsController;
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
    return view('welcome');
})->name('contacts');


Auth::routes();

Route::get('/', [App\Http\Controllers\ContactsController::class, 'index'])
    ->middleware('auth')
    ->name('home');
Route::get('/contacts/history', [App\Http\Controllers\ContactsController::class, 'history'])->name('contacts.history');
Route::get('/contacts/errors', [App\Http\Controllers\ContactsController::class, 'errors'])->name('contacts.errors');
Route::post('/contacts', [App\Http\Controllers\ContactsController::class, 'import'])->name('contacts.import');
