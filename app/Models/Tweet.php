<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static orderBy(string $string)
 * @method static where(string $string, $id)
 */
class Tweet extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tweets';

    public function user() {
        return $this->belongsTo(User::class)->withDefault();
    }
}
