<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'description',
        'code',
        'manager_name',
        'assistant_1_name',
        'assistant_2_name',
        'phone',
        'manager_phone',
        'cost',
        'cost_wifi',
        'cost_water',
        'cost_electricity',
        'cost_other'
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function roomTypes()
    {
        return $this->hasMany(RoomType::class);
    }
}
