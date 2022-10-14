<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable = ['room_id', 'is_thumbnail', 'link', 'order'];
    protected $appends = ['image_url'];
    
    public function getImageUrlAttribute()
    {
        return \Storage::url('images/' . $this->link); 
    }

}
