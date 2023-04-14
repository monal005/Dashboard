<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    use HasFactory;

    protected $table='blogs';
    protected $fillable=[
        'user_id','title','description'
    ];

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function images(){
        return $this->hasMany(BlogsImages::class);
    }
}
