<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Relationship
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id'); // category_id is foreign key in product table
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id'); // brand_id is foreign key in product table
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id'); // sub_category_id is foreign key in product table
    }

    public function childCategory()
    {
        return $this->belongsTo(ChildCategory::class, 'child_category_id'); // child_category_id is foreign key in product table
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id'); // vendor_id is foreign key in product table
    }

    public function images()
    {
        return $this->hasMany(ProductMultiImage::class, 'product_id'); // product_id is foreign key in product_multi_images table
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class, 'product_id'); // product_id is foreign key in product_variants table
    }

    public function flashSaleItem()
    {
        return $this->hasOne(FlashSaleItem::class, 'product_id'); // product_id is foreign key in flash_sale_items table
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class, 'product_id');
    }
}
