<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailVerification extends Model
{
    protected $fillable = ['user_id', 'code', 'expires_at'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
