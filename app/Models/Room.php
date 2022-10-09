<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Plan;
use App\Models\Book;

class Room extends Model
{
    protected $fillable = ['title', 'description', 'room_size', 'min_capacity', 'max_capacity', 'bed_type', 'facilities'];
    use HasFactory;

    public function plans()
    {
        return $this->hasMany(Plan::class);
    }

    public function book()
    {
        return $this->hasManyThrough(Book::class, Plan::class);
    }
}
