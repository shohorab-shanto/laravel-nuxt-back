<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SelectedBeneficiary extends Model
{
    use HasFactory;
    protected $table = 'selected_beneficiaries';

    protected $fillable = [
        'user_id',
        'beneficiary_id',
        'status_id',
        'is_approved',
        'otp_verified',
        'created_by',
    ];

    /**
     * Get the user that owns the SelectedBeneficiary
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the beneficiary that owns the SelectedBeneficiary
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function beneficiary(): BelongsTo
    {
        return $this->belongsTo(Beneficiary::class, 'beneficiary_id', 'id');
    }

    /**
     * Get the status that owns the SelectedBeneficiary
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
