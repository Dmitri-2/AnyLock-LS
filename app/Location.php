<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Locker;

class Location extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'is_available', 'numrows', 'height', 'width', 'depth', 'dept'
    ];

    public function getLockers(){
    	return Locker::where('location_id', $this->id)->orderBy('locker_num')->get();
    }
}
