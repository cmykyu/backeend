<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'img', 'type', 'sort', 'content'
    ];

    public function products(){
        return $this->hasMany('App\Products')->orderby('sort','desc');
    }


}
