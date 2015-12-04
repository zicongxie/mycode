<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LocationData extends Model
{
    //
    protected $table = 'location_data';

    public $timestamps = false;

    protected $guarded = array();

    protected  $dateFormat = 'U';

}
