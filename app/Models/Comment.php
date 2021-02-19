<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user',
        'comment'
    ];

    public function replies()
    {
        return $this->hasMany('App\Models\Comment', 'parent_id');
    }
}
