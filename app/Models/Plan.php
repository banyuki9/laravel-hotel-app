<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = ['room_id', 'title', 'order', 'day_fee', 'holiday_fee', 'plan_detail'];
    use HasFactory;
}
