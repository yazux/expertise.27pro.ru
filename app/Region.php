<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Resizable;
use Cache;

class Region extends Model
{
    use Resizable;

    protected $table = 'regions';

    public $fillable = [
        'id',
        'name',
        'hero_image',
        'description',
        'sort',
        'password',
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;

    public function getProjectsCountAttribute()
    {
        $Vendors = [];
        $Projects = 0;
        if (isset($this->vendors) && count($this->vendors)) $Vendors = $this->vendors;
        else $Vendors = $this->vendors()->get();

        if (count($Vendors)) foreach ($Vendors as $Vendor) $Projects += $Vendor->projects()->count();
    
        return $Projects;
    }

    public function getProjectsAttribute()
    {
        $Vendors = [];
        $Projects = [];
        if (isset($this->vendors) && count($this->vendors)) $Vendors = $this->vendors;
        else $Vendors = $this->vendors()->get();
        
        if (count($Vendors)) foreach ($Vendors as $Vendor) $Projects = array_merge($Projects, $Vendor->projects()->get()->toArray());
    
        return $Projects;
    }

    /**
     * Связь с проектами
     * @return mixed
     */
    public function vendors()
    {
        return $this->hasMany('App\Vendor', 'region_id');
    }
}
