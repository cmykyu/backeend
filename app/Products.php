<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'img', 'title', 'content', 'sort'
    ];

    public function products(){
        return $this->hasMany('App\Products')->orderby('sort','desc');
    }


}
