<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    use HasFactory;
    protected $table = 'articles';
    protected $fillable = 
    [
        'id',
        'title',
        'body',
        'genre_id',
        'created_at',
        'updated_at',
        'completion_at'
    ];

    public $timestamps = false;
}

