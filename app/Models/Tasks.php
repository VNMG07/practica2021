<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;
    public $table = 'tasks';
    protected $fillable = [
        'name',
        'tasks_id',
        'description',
        'assigments',
        'status',
    ];
}
