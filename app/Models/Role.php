<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Role extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [

        'name',
        'desc_name',
        'code'
    ];

    public function permissions(){

        return $this->belongsToMany(Permission::class, 'permission_roles', 'permission_id', 'id');
    }

    
}
