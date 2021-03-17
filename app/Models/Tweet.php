<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tweets';

    protected $fillable = [
        'message',
        'user_id',
        'is_retweet',
        'user_id_retweet',
        'retweet_id'
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function retweet()
    {
        return $this->BelongsTo(Tweet::class, 'retweet_id');
    }

    public function images()
    {
        return $this->hasOne(TweetsImage::class);
    }

    public function hasImage()
    {
        return !is_null($this->images()->first());
    }

    public function getImageAttribute()
    {
        if (isset($this->images->img_path)) {
            return asset('/storage/' . $this->images->img_path);
        }
        return null;
    }

    /**
     * Checks if the tweet has already been retweeted by the user passed as a parameter
     *
     * @param $user_id
     * @param $tweet_id
     * @return bool
     */
    public static function alreadyRetweeted($user_id, $tweet_id): bool
    {
        return !is_null(self::where('is_retweet', true)
            ->where('retweet_id', $tweet_id)
            ->where('user_id', $user_id)
            ->first());
    }

    public function getAgeAttribute()
    {
        if ($this->created_at->diffInDays() < 7) {
            return $this->created_at->locale('fr_FR')->diffForHumans(['options' => Carbon::ONE_DAY_WORDS]);
        } else {
            return $this->created_at->isoFormat('DD/MM/YY à HH:mm');
        }
    }
}
