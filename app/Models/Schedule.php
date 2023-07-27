<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $table = 'schedules';
    protected $fillable = 
    [
        'id',
        'title',
        'start_date',
        'end_date',
        'created_at',
        'updated_at',
        'user_id',
    ];

    public $timestamps = false;
}
