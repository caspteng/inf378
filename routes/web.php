<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TweetController;
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
    return view('home');
});


require __DIR__.'/auth.php';


### TWEET ###

Route::get('/tweet', [TweetController::class, 'getAllTweet']);
Route::get('/tweet/{name}', [TweetController::class, 'getAllUserTweetByUsername']);

### PROFIL PAGE ###
Route::get('/profile', function() {
    return redirect('/' . auth()->user()->username);
})->middleware(['auth'])->name('profile');
Route::get('/{username}', [ProfileController::class, 'show']);
