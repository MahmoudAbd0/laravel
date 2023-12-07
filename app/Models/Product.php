<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'price', 'quantity', 'category_id', 'image'
    ];

    public function imageUrl()
    {
        return Storage::url($this->image);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, "category_id");
    }
}
