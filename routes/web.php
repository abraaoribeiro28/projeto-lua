<?php


use App\Http\Controllers\Portal\HomeController;
use App\Http\Controllers\Portal\PostController;
use App\Http\Controllers\Portal\SubscriberController;
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

Route::get('/', HomeController::class)->name('portal.home');

// Postagens
Route::get('posts/{slug}', [PostController::class, 'show'])->name('posts.show');

// Subscriber
Route::post('ajax-subscribe', [SubscriberController::class, 'store'])->name('ajax.subscribe');

require __DIR__.'/auth.php';
