<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Resizable;
use Cache;

class News extends Model
{
    use Resizable;

    protected $table = 'news';

    public $fillable = [
        'id',
        'text',
        'region_id',
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;
   
    public function region()
    {
        return $this->belongsTo('App\Region');
    }
}
