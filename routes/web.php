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
    return view('welcome');
})
    ->middleware('guest');

### HOME (TIMELINE) ###
// TODO: Adding Timeline
Route::get('/home', function () {
    return redirect('/profile');
})
    ->middleware('auth')
    ->name('home');

require __DIR__ . '/auth.php';


### TWEET ###

Route::get('/tweet', [TweetController::class, 'getAllTweet']);
Route::post('/tweet/create', [TweetController::class, 'store'])
    ->middleware('auth')
    ->name('create_tweet');
Route::get('/tweet/{id}/destroy', [TweetController::class, 'drop'])
    ->middleware('auth')
    ->name('destroy_tweet');

### RETWEET SYSTEM ###
Route::get('/retweet/{tweet_id}/undo', [TweetController::class, 'undoRetweet'])
    ->middleware('auth')
    ->name('retweet_undo');
Route::get('/retweet/{tweet_id}', [TweetController::class, 'retweet'])
    ->middleware('auth')
    ->name('retweet');


### PROFIL PAGE ###
Route::get('/profile', function () {
    return redirect('/' . auth()->user()->username);
})->middleware('auth')->name('profile');
Route::get('/{username}', [ProfileController::class, 'show']);


### FOLLOWING SYSTEM ###

Route::get('follow/{id}', [UserController::class, 'follow'])
    ->middleware('auth');
Route::get('unfollow/{id}', [UserController::class, 'unfollow'])
    ->middleware('auth');

### LIKE SYSTEM ###

Route::get('like/{id}', [TweetController::class, 'likeOrUnlike'])
    ->middleware('auth')
    ->name('like');
