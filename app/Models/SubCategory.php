<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    // Relationship
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id'); // category_id is foreign key in sub_categories table
    }

    public function childCategories()
    {
        return $this->hasMany(ChildCategory::class, 'sub_category_id'); // sub_category_id is foreign key in child_categories table
    }
}
