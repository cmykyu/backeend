<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductTypes extends Model
{
    protected $table = 'producttype';
    protected $fillable = [
         'type',  'sort'
    ];

    public function products(){
        return $this->hasMany('App\ProductType')->orderby('sort','desc');
    }
}
