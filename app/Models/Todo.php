<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todo extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'content', 'isFavorite', 'color'];

    protected $dates = ['deleted_at'];
}

