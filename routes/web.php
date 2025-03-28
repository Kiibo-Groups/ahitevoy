<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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
    return view('website/index');
})->name('home');


/*
|-----------------------------------------------
| Services
|--------- -------------------------------------
*/
Route::get('services', [HomeController::class, 'services'])->name('services');


/*
|-----------------------------------------------
| Clients
|--------- -------------------------------------
*/
Route::get('clients', [HomeController::class, 'clients'])->name('clients');

/*
|-----------------------------------------------
| Contact
|--------- -------------------------------------
*/
Route::get('contact', [HomeController::class, 'contact'])->name('contact');


/*
|-----------------------------------------------
| Newsletter
|--------- -------------------------------------
*/
Route::post('newsletter', [HomeController::class, 'newsletter'])->name('newsletter');