<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable([
        'schedule_id',
        'meeting_number',
        'meeting_date',
        'topic',
        'description',
        'status',
    ])]
class Meeting extends Model
{
    use SoftDeletes;

    public const DEFAULT_TOTAL_MEETINGS = 16;

    public const STATUS_SCHEDULED = 'Terjadwal';

    public const STATUS_COMPLETED = 'Selesai';


    public const STATUSES = [
        self::STATUS_SCHEDULED,
        self::STATUS_COMPLETED,
    ];

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class);
    }

    public function paymentDetail()
    {
        return $this->hasOne(HonorPaymentDetail::class);
    }
}
