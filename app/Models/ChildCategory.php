<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildCategory extends Model
{
    use HasFactory;

    // Relationship
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id'); // category_id is foreign key in child_categories table
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id'); // sub_category_id is foreign key in child_categories table
    }
}
