<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable([
        'lecturer_id',
        'month',
        'year',
        'total',
        'status',
        'generated_by',
        'generated_at',
        'paid_at',
    ])]
class HonorPayment extends Model
{
    use SoftDeletes;

    const STATUS_DRAFT     = 'DRAFT';
    const STATUS_PAID      = 'PAID';
    const STATUS_CANCELLED = 'CANCELLED';

    public static function statuses()
    {
        return [
            self::STATUS_DRAFT,
            self::STATUS_PAID,
            self::STATUS_CANCELLED,
        ];
    }

    protected $casts = [
        'generated_at' => 'datetime',
        'paid_at'      => 'datetime',
    ];

    public function lecturer(): BelongsTo
    {
        return $this->belongsTo(Lecturer::class);
    }
    public function details()
    {
        return $this->hasMany(HonorPaymentDetail::class, 'payment_id');
    }

    public function generatedBy()
    {
        return $this->belongsTo(User::class, 'generated_by');
    }
}
