<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'service_id',
        'user_name',
        'stars',
        'comment'
    ];
}
