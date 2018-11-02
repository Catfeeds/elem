<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    //
    protected $fillable=["shop_name","shop_img","brand","fengniao","status","shop_cate_id","user_id"];

    public function cate()
    {
        return $this->belongsTo(ShopCategory::class,"shop_cate_id");
    }
    public function user()
    {
        return $this->belongsTo(User::class,"user_id");
    }

    public function menucate(){
       return  $this->hasMany(MenuCategory::class,"shop_id");
    }

}
