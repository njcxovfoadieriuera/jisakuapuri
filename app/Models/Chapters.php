<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapters extends Model
{
    use HasFactory;
    protected $table = 'chapters';
    protected $fillable = 
    [
        'id',
        'title',
        'body',
        'articles_id',
        'created_at',
        'updated_at',
        'completion_at'
    ];

    public $timestamps = false;
} 