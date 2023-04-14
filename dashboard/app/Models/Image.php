<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;
    protected $table='post_images';
    protected $fillable=[
        'posts_id','image',
    ];

    protected $appends = array('image_url');

    public function posts(){
        return $this->belongsTo(Post::class);
    }

    public function getImageUrlAttribute()
    {
        $image_url = '';
        if($this->image){
            $image_url = asset(Storage::url($this->image));
        }
       return $image_url;
    }
}
