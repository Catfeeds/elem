<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    //
    protected $fillable=["name","img","brand","fengniao","status","user_id"];

    public function cate()
    {
        return $this->belongsTo(ShopCategory::class,"shop_cate_id");
    }

}
