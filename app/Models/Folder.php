<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;
    protected $table = 'Folders';
    protected $fillable = 
    [
        'id',
        'user_id',
        'title',
        'favorite_id',
        'created_at',
    ];

    public $timestamps = false;
}
