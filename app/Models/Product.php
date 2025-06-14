<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\OrderItem;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'slug',
        'price',
        'description',
        'file_path',
    ];

    public function seller()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getCoverUrlAttribute(): string
    {
        return Storage::disk('products')->url($this->file_path);
    }
}
