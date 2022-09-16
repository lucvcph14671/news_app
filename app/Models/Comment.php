<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'comment',
        'user_id',
        'post_id'
    ];

    public function nameUser(){
        
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function titlePost(){

        return $this->belongsTo(post::class,'post_id','id');
    }

   
}
