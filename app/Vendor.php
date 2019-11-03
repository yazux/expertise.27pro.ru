<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Resizable;
use Cache;

class Vendor extends Model
{
    use Resizable;

    protected $table = 'vendors';

    public $fillable = [
        'id',
        'name',
        'logo',
        'hero_image',
        'photos',
        'description',
        'description_short',
        'sort',
        'price',
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;

    public function getProjectsCountAttribute()
    {
        return $this->projects()->count();
    }

    public function getProjecsInWorksCountAttribute()
    {
        return $this->projects()->whereIn('status', ['planned','work'])->count();
    }

    public function getWorkProgressAttribute()
    {
        $Projects = $this->projects()->select('id', 'percent')->get();
        if (!count($Projects)) return 0;
        $AllProgress = 0;
        foreach ($Projects as $Project) $AllProgress += (float) $Project->percent;
        return $AllProgress / count($Projects);
    }


    public function getFullPriceAttribute()
    {
        $Price = 0;
        if ($this->price) $Price = $this->price;
        else {
            $Prices = $this->projects()->whereNotNull('price')->where('price', '>', 0)
                ->select('price')->get()->pluck('price');
            foreach ($Prices as $price) $Price += (int) $price;
        }
        return $Price;
    }

    /**
     * Связь с проектами
     * @return mixed
     */
    public function projects()
    {
        return $this->hasMany('App\Project', 'vendor_id');
    }

    public function region()
    {
        return $this->belongsTo('App\Region');
    }
}
