<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConTacts extends Model
{
    protected $table = 'contacts';
    protected $fillable = [
        'name', 'email', 'phone', 'message'
    ];

    public function news_imgs(){
        return $this->hasMany('App\NewsImgs')->orderby('sort','desc');
    }

}
