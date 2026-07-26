<?php
namespace App\Models;

use App\Models\Lecturer;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable([
        'user_id',
        'nip',
        'name',
        'gender',
        'phone',
        'address',
    ])]
class Employee extends Model
{
    use SoftDeletes;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function employmentStatus(): BelongsTo
    {
        return $this->belongsTo(EmploymentStatus::class);
    }

    public function lecturer(): HasOne
    {
        return $this->hasOne(Lecturer::class);
    }
}
