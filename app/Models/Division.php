<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Division extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'bn_name',
        'url',
    ];

    /**
     * Get all of the district for the Division
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function district(): HasMany
    {
        return $this->hasMany(District::class, 'division_id', 'id');
    }
}
