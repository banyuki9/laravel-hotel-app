<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $appends = ['image_url'];
    
    public function getImageUrlAttribute()
    {
        return \Storage::url('images/' . $this->link); // storageフォルダを起点としてファイルパスを生成してreturnする
    }
}
