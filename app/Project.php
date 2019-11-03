<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Resizable;
use Cache;
use Voyager;

class Project extends Model
{
    use Resizable;

    protected $table = 'projects';

    public $fillable = [
        'id',
        'name',
        'description',
        'description_short',
        'percent',
        'photo',
        'photos',
        'videos',
        'start_date',
        'end_date',
        'status',
        'docs',
        'vendor_id',
        'price',
        'sort',
        'created_at',
        'updated_at'
    ];

    public $statuses = [
        'planned' => 'В плане',
        'work' => 'В работе',
        'done' => 'Закончен'
    ];

    public $timestamps = true;

    public function preparePhotos() 
    {
        $Photos = [];
        if (!$this->photos) return $Photos;
        if (is_string($this->photos)) $this->photos = json_decode($this->photos, true);
        foreach ($this->photos as $photo) {
            $path = base_path('public/storage/' . $photo);
            if (file_exists($path)) {
                $date = date("d.m.Y", filemtime($path));
                if (!isset($Photos[$date])) $Photos[$date] = [];
                $thumbnail = str_replace(env('APP_URL', 'http://demoexpertise.27pro.ru'), '', Voyager::image($this->getThumbnail($photo, 'cropped')));
                $thumbnailPath = base_path('public/storage/' . $thumbnail);
                $Photos[$date][] = [
                    'time'  => filemtime($path),
                    'date'  => date("d.m.Y 00:00:00", filemtime($path)),
                    'path'  => $path,
                    'url'   => '/storage/' . $photo,
                    'thumbnail' => file_exists($thumbnailPath) ? $thumbnail : ('/storage/' . $photo)
                ];
            }
        }
        return $Photos;
    }

    public function getStatusNameAttribute()
    {
        return $this->statuses[$this->status];
    }

    
    /**
     * Связь с заказчиком
     * @return mixed
     */
    public function vendor()
    {
        return $this->belongsTo('App\Vendor', 'vendor_id');
    }
}
