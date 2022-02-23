<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ReactionPointController;

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
})->name('home');

Route::resource('articles', ArticleController::class);

Route::prefix('reaction-points/')->middleware('auth')->group(function () {
    Route::post('good/{reactionPointableType}/{reactionPointableId}', [ReactionPointController::class, 'makeGood'])->name('reaction-points.make-good');
    Route::delete('good/{reactionPointableType}/{reactionPointableId}', [ReactionPointController::class, 'cancelGood'])->name('reaction-points.cancel-good');
    Route::post('bad/{reactionPointableType}/{reactionPointableId}', [ReactionPointController::class, 'makeBad'])->name('reaction-points.make-bad');
    Route::delete('bad/{reactionPointableType}/{reactionPointableId}', [ReactionPointController::class, 'cancelBad'])->name('reaction-points.cancel-bad');
});

Auth::routes();
