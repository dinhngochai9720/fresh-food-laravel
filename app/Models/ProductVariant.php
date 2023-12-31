<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    public function variantItems()
    {
        return $this->hasMany(ProductVariantItem::class, 'variant_id');  // variant_id is foreign key in product_variant_items table
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
