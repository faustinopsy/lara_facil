<?php

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
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::middleware('auth')->group(function () {
    //Route::post('/lottery', [\App\Http\Controllers\LotteryController::class, 'store'])->name('lottery.store');
    //Route::get('/lottery', [\App\Http\Controllers\LotteryController::class, 'index'])->name('lottery.index');
    Route::get('/lottery', \App\Http\Livewire\LotteryForm::class)->name('lottery');
    Route::get('/list', \App\Http\Livewire\UserLotteries::class)->name('list');
    Route::get('/busca', \App\Http\Livewire\FetchLotteryData::class)->name('busca');
    Route::get('/code/{type}', \App\Http\Livewire\FetchLotteryData::class)->name('code.show');

});