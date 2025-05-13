<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $fillable=['category_id','subcategory_id','size','min','max'];

    public function category(){
        return $this->belongsTo(Category::class);
    }
     public function subcategory(){
        return $this->belongsTo(SubCategory::class);
    }
    public function prodouctId()
    {
        return $this->hasone(ProductModel::class);
    }
}
