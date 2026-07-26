<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable([
        'code',
        'name',
        'is_active',
    ])]
class Semester extends Model
{
    use SoftDeletes;

    public function courseOfferings()
    {
        return $this->hasMany(CourseOffering::class);
    }
}
