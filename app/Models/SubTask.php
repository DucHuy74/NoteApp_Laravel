<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubTask extends Model
{
    public function note() {
        return $this->belongsTo(Note::class);
    }

}