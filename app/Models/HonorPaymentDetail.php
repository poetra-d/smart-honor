<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable([
        'payment_id',
        'meeting_id',
        'course_offering_id',
        'sks',
        'rate',
        'subtotal'
    ])]
class HonorPaymentDetail extends Model
{
    use SoftDeletes;

    public function payment(): BelongsTo
    {
        return $this->belongsTo(HonorPayment::class, 'payment_id');
    }

    public function meeting(): BelongsTo
    {
        return $this->belongsTo(Meeting::class);
    }

    public function courseOffering(): BelongsTo
    {
        return $this->belongsTo(CourseOffering::class);
    }
}
