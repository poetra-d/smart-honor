<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable([
        'course_offering_id',
        'room_id',
        'day',
        'start_time',
        'end_time',
        'total_meetings',
    ])]
class Schedule extends Model
{
    use SoftDeletes;

    public const DAYS = [
        'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu',
    ];

    public function courseOffering(): BelongsTo
    {
        return $this->belongsTo(CourseOffering::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function meetings()
    {
        return $this->hasMany(Meeting::class);
    }
}
