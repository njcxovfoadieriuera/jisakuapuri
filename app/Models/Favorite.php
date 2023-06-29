<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;
    protected $table = 'Favorite';
    protected $fillable = 
    [
        'id',
        'user_id',
        'chapter_id',
        'created_at',
        'updated_at',
    ];

    public $timestamps = false;
}
