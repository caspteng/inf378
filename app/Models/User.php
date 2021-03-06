<?php

namespace App\Models;

use App\Helpers\Hash;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use TweetUser;


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
        'biography',
        'avatar_picture',
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

    public function getAvatarAttribute()
    {
        if (isset($this->avatar_picture)) {
            return asset('/storage/' . $this->avatar_picture);
        } else {
            return '//eu.ui-avatars.com/api/?size=290&&color=ffffff&background=555b6e&name='
                . $this->surname . '&format=svg';
        }
    }

    public function setPasswordAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['password'] = Hash::make($value);
        }
    }

    public function getProfilWidgetAttribute()
    {
        return "
        <img src='" . $this->avatar . "' alt='' class='ui avatar image'>
        <div class='header'>" . $this->surname . "</div>
        <p style='color: grey'>@" . $this->username . "</p>
        <p>" . $this->biography . "</p>
        <p><b>" . $this->count_following . "</b><span style='color: grey'> abonnements</span>
        <b>" . $this->count_follower . "</b><span style='color: grey'> abonnés</span></p>
        ";

    }

    public function tweet()
    {
        return $this->hasMany(Tweet::class);
    }

    public function sent()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }
    public function received()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }
    /**
     * Retrieves list of user's tweets
     *
     */
    public function timeline()
    {
        return $this->tweet()->with('user')->latest()->paginate(10);
    }

    /**
     * Retrieve tweets from followed users
     *
     */
    public function feed()
    {
        $friends = $this->following()->pluck('id');

        return Tweet::with('user')
            ->whereIn('user_id', $friends)
            ->orWhere('user_id', $this->id)
            ->latest()->paginate(20);
    }

    /**
     * Function to follow a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function following()
    {
        return $this->belongsToMany(User::class, 'follows',
            'user_as_follow', 'user_followed')
            ->withTimestamps();
    }


    /**
     * Users that follow this user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function follower()
    {
        return $this->belongsToMany(User::class, 'follows',
            'user_followed', 'user_as_follow');
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
        return $this->belongsToMany(Tweet::class, 'likes', 'user_id', 'tweet_id');
    }

    /**
     * Count users that follow this user
     *
     * @return int
     */
    public function getCountFollowerAttribute()
    {
        return count($this->follower);
    }

    /**
     * Get following user count
     *
     * @return int
     */
    public function getCountFollowingAttribute()
    {
        return count($this->following);
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

    public function path($append = '')
    {
        $path = route('profile', $this->username);
        return $append ? "{$path}/{$append}" : $path;
    }

    public function sendMessageTo($receiver, $message)
    {
        return $this->sent()->create([
            'message' => $message,
            'receiver_id' => $receiver
        ]);
    }

}
