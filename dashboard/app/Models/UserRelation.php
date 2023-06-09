<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRelation extends Model
{
    use HasFactory;
    protected $table = 'users';

    public function posts(){
        return $this->hasMany(Post::class);
    }
}
