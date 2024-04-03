<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LatrineStep extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
    ];
}
