<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domains extends Model
{
    protected $fillable = [
        'name',
        'contentLength',
        'responseCode',
        'body',
        'h1',
        'keywords',
        'description'
    ];
}
