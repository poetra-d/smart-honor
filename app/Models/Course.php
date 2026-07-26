<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable([
        'study_program_id',
        'code',
        'name',
        'sks',
    ])]
class Course extends Model
{
    use SoftDeletes;

    public function studyProgram(): BelongsTo
    {
        return $this->belongsTo(StudyProgram::class);
    }

    public function courseOfferings()
    {
        return $this->hasMany(CourseOffering::class);
    }
}
