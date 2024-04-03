<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class District extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'bn_name',
        'lat',
        'lon',
        'url',
        'slug',
        'division_id',
    ];

    /**
     * Get all of the upazila for the District
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function upazila(): HasMany
    {
        return $this->hasMany(Upazila::class, 'district_id', 'id');
    }
}
