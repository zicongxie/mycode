<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TopicsShow extends Model
{
    //
    protected $table = 'topics_show';

    public $timestamps = true;

    protected $guarded = array();

    protected  $dateFormat = 'U';

    protected $dates = ['created_at'];

    public function location(){
        return $this->hasOne('App\Model\LocationData','city_code','city_code');
    }
}
