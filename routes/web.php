<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\UserController;
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
Route::get('/tweet/create', [TweetController::class, 'showTweetForm'])
->name('showTweetForm');
Route::post('/tweet/create', [TweetController::class, 'store']);
Route::get('/tweet/{name}', [TweetController::class, 'getAllUserTweetByUsername']);
Route::get('/retweet/{tweet_id}', [TweetController::class, 'retweet']);


### PROFIL PAGE ###
Route::get('/profile', function() {
    return redirect('/' . auth()->user()->username);
})->middleware(['auth'])->name('profile');
Route::get('/{username}', [ProfileController::class, 'show']);


### FOLLOWING SYSTEM ###

Route::get('follow/{id}', [UserController::class, 'follow'])
    ->middleware(['auth']);
Route::get('unfollow/{id}', [UserController::class, 'unfollow'])
    ->middleware(['auth']);
