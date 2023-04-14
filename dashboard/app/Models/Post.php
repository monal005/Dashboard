<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table='posts';
    protected $fillable=[
        'name','user_id'
    ];

    protected $casts = [
        'image' => 'array'
    ];
    public function images()
    {
        return $this->hasMany('App\Models\Image', 'posts_id','id')->ondelete('cascade');
    }

    public function userRelation(){
        return $this->belongsTo(UserRelation::class,'user_id');
    }

    public function newUser(){
        return $this->belongsToMany(NewUserModel::class,'new_user_model');
    }
}
