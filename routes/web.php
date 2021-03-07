<?php

use App\Http\Controllers\AccountSettingsController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\MessageController;
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
Route::get('/home', [TweetController::class, 'index'])
    ->middleware('auth')
    ->name('home');

require __DIR__ . '/auth.php';


### TWEET ###

Route::post('/tweet/create', [TweetController::class, 'store'])
    ->middleware('auth')
    ->name('create_tweet');
Route::get('/tweet/{tweet:id}/destroy', [TweetController::class, 'drop'])
    ->middleware('auth')
    ->name('destroy_tweet');

### RETWEET SYSTEM ###
Route::get('/retweet/{tweet_id}/undo', [TweetController::class, 'undoRetweet'])
    ->middleware('auth')
    ->name('retweet_undo');
Route::get('/retweet/{tweet_id}', [TweetController::class, 'retweet'])
    ->middleware('auth')
    ->name('retweet');


### FOLLOWING SYSTEM ###


Route::middleware('auth')->group(function () {
    Route::get('/follow/{user:id}', [UserController::class, 'follow']);
    Route::get('/unfollow/{user:id}', [UserController::class, 'unfollow']);
});

### LIKE SYSTEM ###

Route::get('/like/{tweet:id}', [TweetController::class, 'likeOrUnlike'])
    ->middleware('auth')
    ->name('like');

### EXPLORE PAGE ###
Route::get('/explore', [ExploreController::class, 'show'])
    ->name('explore');

### SETTINGS PAGE ###

Route::get('/settings', [AccountSettingsController::class, 'show'])
    ->middleware('auth')
    ->name('settings');
Route::patch('/settings', [AccountSettingsController::class, 'update'])
    ->middleware('auth');

### PRIVATE MESSAGES PAGE ###

Route::get('/messages/{user:id}', [MessageController::class, 'show'])
    ->middleware('auth')
    ->name('messages');
Route::post('/messages/{user:id}', [MessageController::class, 'store'])
    ->middleware('auth');

### PROFIL PAGE ###

Route::patch('/{user:username}', [ProfileController::class, 'update'])
    ->middleware('auth');
Route::get('/{user:username}', [ProfileController::class, 'show'])
    ->name('profile');
Route::get('/{user:username}/following', [ProfileController::class, 'showFollowing'])
    ->name('following');
Route::get('/{user:username}/followers', [ProfileController::class, 'showFollowers'])
    ->name('followers');

