<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus'; // nama tabel di database
    protected $fillable = ['category_id', 'name', 'rating', 'price', 'description', 'image']; // kolom tabel

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
