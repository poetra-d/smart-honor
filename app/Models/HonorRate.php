<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable([
        'employment_status_id',
        'rate_per_sks',
        'effective_date',
    ])]
class HonorRate extends Model
{
    use SoftDeletes;

    public function employmentStatus(): BelongsTo
    {
        return $this->belongsTo(EmploymentStatus::class);
    }

}
