<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable([
        'code',
        'name',
    ])]
class EmploymentStatus extends Model
{
    use SoftDeletes;

    public function honorRates()
    {
        return $this->hasMany(HonorRate::class);
    }
}
