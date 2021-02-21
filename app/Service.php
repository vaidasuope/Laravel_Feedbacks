<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'gender',
        'specialization_id',
        'company_id',
        'description',
        'city',
        'img'
    ];

}
