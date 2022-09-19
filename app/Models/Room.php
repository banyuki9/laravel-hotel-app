<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = ['title', 'description', 'room_size', 'min_capacity', 'max_capacity', 'bed_type', 'facilities'];
    use HasFactory;
}
