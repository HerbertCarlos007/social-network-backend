<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AboutProfile extends Model
{
    protected $fillable = [
        'user_id',
        'about',
        'works_at',
        'studied_at',
        'lives_in'
    ];

    public  function  user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
