<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['category', 'status'];

    public function subcategory()
    {
        return $this->hasone(SubCategory::class);
    }
    public function Size()
    {
        return $this->hasone(Size::class);
    }
    public function prodouct()
    {
        return $this->hasone(ProductModel::class);
    }


}
