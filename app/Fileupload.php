<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fileupload extends Model
{
    protected $fillable = [
        'id', 'name', 'created_at', 'updated_at'
    ];

}
