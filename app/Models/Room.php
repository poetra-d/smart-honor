<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable([
        'room_name',
        'building_name',
        'capacity',
    ])]
class Room extends Model
{
    use SoftDeletes;

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
