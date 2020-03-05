<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $news_id
 * @property string $img_url
 * @property integer $sort
 * @property string $created_at
 * @property string $updated_at
 */
class NewsImgs extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = '_news_img';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['news_id', 'img_url', 'sort', 'created_at', 'updated_at'];

}
