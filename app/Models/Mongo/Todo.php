<?php

namespace App\Models\Mongo;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';

    protected $fillable = [
        'description',
        'user_id'
    ];
}
