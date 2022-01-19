<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'name',
        'description',
        'image',
        'slug'
    ];

    protected $dates = [
        'deleted_at',
    ];

    protected static function booted()
    {
        static::creating(function ($category) {
            $category->slug = Str::of($category->name)->slug('-');
        });
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
