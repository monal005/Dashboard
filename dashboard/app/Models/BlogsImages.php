<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class BlogsImages extends Model
{
    use HasFactory;
    protected $table='blogs_images';

    public  function blogs()
    {
        return $this->belongsTo(Blogs::class);
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
