<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Upazila extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'bn_name',
        'lat',
        'lon',
        'url',
        'slug',
        'district_id',
    ];

    /**
     * Get all of the union for the District
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function union(): HasMany
    {
        return $this->hasMany(Union::class, 'upazila_id', 'id');
    }

}
