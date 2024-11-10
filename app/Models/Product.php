<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'meta_title',
        'meta_keyword',
        'meta_description',
        'slug',
        'name',
        'description',
        'status',
        'brand',
        'category_id',
        'popular',
        'featured',
        'selling_price',
        'original_price',
        'quantity',
        'image',


    ];

    protected $with = ['category'];
    public function category(){

        return $this->belongsTo(Category::class, 'category_id', 'id');

    }
}

