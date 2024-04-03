<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Beneficiary extends Model
{
    use HasFactory;

    protected $table = 'beneficiaries';
    protected $fillable = [
        'name',
        'phone',
        'type',
        'address',
        'status',
        'nid',
        'photo',
        'gender',
        'religion',
        'division_id',
        'district_id',
        'upazila_id',
        'union_id',
        'created_by',
        'password',
    ];

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function upazila(): BelongsTo
    {
        return $this->belongsTo(Upazila::class);
    }

    public function union(): BelongsTo
    {
        return $this->belongsTo(Union::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'selected_beneficiaries')
            ->withPivot(['status_id', 'is_approved', 'otp_verified', 'created_by'])
            ->withTimestamps();
    }
}
