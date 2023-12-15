<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMultiImage extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id'); // product_id is foreign key in product_multi_image table
    }
}
