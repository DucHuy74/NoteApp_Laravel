<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Note extends Model
{
     protected $fillable = ['title', 'text', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}