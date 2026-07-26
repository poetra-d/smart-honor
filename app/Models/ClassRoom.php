<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Table('classes')]
#[Fillable([
        'study_program_id',
        'academic_year_id',
        'is_active',
        'code',
        'name',
        'quota',
    ])]
class ClassRoom extends Model
{
    use SoftDeletes;

    public function studyProgram(): BelongsTo
    {
        return $this->belongsTo(StudyProgram::class);
    }

    public function academicYear(): BelongsTo
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function courseOfferings()
    {
        return $this->hasMany(CourseOffering::class, 'class_id');
    }
}
