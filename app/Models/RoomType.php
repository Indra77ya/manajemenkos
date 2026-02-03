<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;

    protected $fillable = ['branch_id', 'name', 'price', 'facilities'];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
