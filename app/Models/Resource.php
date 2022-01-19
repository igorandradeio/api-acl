<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = ['name'];


    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }
}
