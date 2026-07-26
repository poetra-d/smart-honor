<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable([
        'employee_id',
        'employment_status_id',
        'study_program_id',
        'nidn',
    ])]
class Lecturer extends Model
{
    use SoftDeletes;

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function employmentStatus(): BelongsTo
    {
        return $this->belongsTo(EmploymentStatus::class);
    }

    public function studyProgram(): BelongsTo
    {
        return $this->belongsTo(StudyProgram::class);
    }

    public function courseOfferings()
    {
        return $this->hasMany(CourseOffering::class);
    }
}
