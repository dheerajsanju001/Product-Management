<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $fillable=['category_id','sub_category','status'];

    public function category(){
        return $this->belongsTo(Category::class);
    }
     public function size_id(){
        return $this->belongsTo(Size::class);
    }
    public function prodouct_id()
    {
        return $this->hasone(ProductModel::class);
    }
}
