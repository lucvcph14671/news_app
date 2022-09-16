<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'id_user',
        'id_category',
        'desc',
        'image'
    ];

    public function category(){

        return $this->belongsTo(category::class,'id_category','id');
    }

    public function nameUser(){
        
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function countComment(){
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }
}
