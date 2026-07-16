<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BillingItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'billing_id',
        'name',
        'amount',
        'quantity',
    ];

    /**
     * Get the associated billing.
     */
    public function billing(): BelongsTo
    {
        return $this->belongsTo(Billing::class);
    }
}
