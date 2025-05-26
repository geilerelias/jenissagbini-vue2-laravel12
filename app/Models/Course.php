<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function content()
    {
        return $this->hasMany('App\Models\Content');
    }
}
