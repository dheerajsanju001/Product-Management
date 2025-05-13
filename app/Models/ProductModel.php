<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $fillable=['category_id','subcategory_id','size_id','status','name','description'];

    public function size(){
        return $this->belongsTo(Size::class);
    }
     public function category(){
        return $this->belongsTo(Category::class);
    }
     public function subcategory(){
        return $this->belongsTo(SubCategory::class);
    }

}
