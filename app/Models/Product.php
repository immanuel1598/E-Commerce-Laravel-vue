<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'title',
        'slug',
        'quantity',
        'description',
        'published',
        'inStock',
        'price',
        'created_by',
        'deleted_by',
    ];
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
    public function product_images(){
        return $this->hasMany(ProductImage::class);
    }
    public function categorie(){
        return $this->belongsTo(Categorie::class);
    }
    public function brand(){
        return $this->belongsTo(Brand::class);
    }

}
