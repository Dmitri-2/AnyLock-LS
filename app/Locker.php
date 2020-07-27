<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Locker extends Model
{
    protected $fillable = [
        'id', 'locker_num','status', 'location_id'
    ];

    // Status can have values: 'available', 'rented', 'pending', 'broken', 'expiring', 'expired'

    public function location(){
        return $this->hasOne('App\Location', 'id', 'location_id');
    }

    public function rent(){
        $this->status = "rented";
        $this->save();
    }

    public function makeAvailable(){
        $this->status = "available";
        $this->save();
    }


}
