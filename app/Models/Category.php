<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function rSubcategory()
    {
        return $this->hasMany(SubCategory::class)->where('show_on_menu','Show')->where('show_on_home','Show')->orderBy('sub_category_order', 'asc');
    }
}
