<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Designation;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'designation_id',
    ];

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(fn ($q) => $q->whereHas('user'));
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }
}
