<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopCategory extends Model
{
    //
    protected $fillable=["name","img","status","sort"];

    public function shops(){
        return $this->hasMany(Shop::class,"shop_cate_id");
    }
}
