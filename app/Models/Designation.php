<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Designation extends Model
{
    use HasFactory;

    protected $logName = 'designations';

    protected $fillable = [
        'id','name','description'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }


}
