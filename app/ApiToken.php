<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiToken extends Model
{
    protected $fillable = ['token', 'expired_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
