<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariantItem extends Model
{
    use HasFactory;

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id'); // variant_id is foreign key in product_variant_items table
    }
}
