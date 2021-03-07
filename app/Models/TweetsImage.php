<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TweetsImage extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function tweet()
    {
        return $this->belongsTo(Tweet::class);
    }
}
