<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tweet extends Model
{
    use SoftDeletes;
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

    public function user() {
        return $this->belongsTo(User::class)->withDefault();
    }

    public static function alreadyRetweeted($user_id, $tweet_id) {
        return !is_null(self::where('is_retweet', true)
            ->where('retweet_id', $tweet_id)
            ->where('user_id', $user_id)
            ->first());
    }
}
