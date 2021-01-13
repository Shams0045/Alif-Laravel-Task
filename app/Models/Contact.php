<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'list';

    protected $fillable = ['name','number','email'];

    protected $casts = [
        'number' => 'array',
        'email' => 'array'
    ];
}
