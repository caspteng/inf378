<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'surname',
        'email',
        'password',
        'birthday',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function tweet()
    {
        return $this->hasMany(Tweet::class);
    }

    /**
     * Retrieves list of user's tweets
     *
     * @return Tweet
     */
    public function timeline()
    {
        return Tweet::where('user_id', $this->id)->latest()->paginate(10);
    }

    /**
     * Retrieve tweets from followed users
     *
     * @return Tweet
     */
    public function feed()
    {
        $friends = $this->following()->pluck('id');

        return Tweet::whereIn('user_id', $friends)
            ->orWhere('user_id', $this->id)
            ->latest()->get();
    }

    /**
     * Function to follow a user
     *
     * @return object
     */
    public function following()
    {
        return $this->belongsToMany(User::class, 'follows',
            'user_as_follow', 'user_followed')
            ->withTimestamps();
    }

    /**
     * Check if the user is following the user passed as a parameter
     *
     * @param User $user
     * @return bool
     */
    public function isFollowing(User $user): bool
    {
        return !is_null($this->following()->where('user_followed', $user->id)->first());
    }

    public function liking()
    {
        return $this->belongsToMany(User::class, 'likes', 'user_id', 'tweet_id');
    }

    /**
     * Check if the user has already liked the tweet
     *
     * @param Tweet $tweet
     * @return bool
     */
    public function isLiking(Tweet $tweet): bool
    {
        return !is_null($this->liking()->where('tweet_id', $tweet->id)->first());
    }

}
