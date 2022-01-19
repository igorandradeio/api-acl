<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = ['name'];


    public function resource()
    {
        return $this->hasMany(Resource::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
