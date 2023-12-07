<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'image'];

    public function imageUrl()
    {
        return Storage::url($this->image);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
