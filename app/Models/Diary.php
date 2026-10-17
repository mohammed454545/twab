<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    protected $fillable = ['title','description','rate','user_id'];

    public function user ()
    {
        return $this->belongsTo(User::class);
    }
}
