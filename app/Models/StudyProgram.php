<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable([
        'faculty_id',
        'code',
        'name',
        'is_active',
    ])]
class StudyProgram extends Model
{
    use SoftDeletes;

    public function faculty(): BelongsTo
    {
        return $this->belongsTo(Faculty::class);
    }
}
