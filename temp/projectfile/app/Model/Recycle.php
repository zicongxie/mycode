<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Recycle extends Model {

    protected $table = 'recycle';

    public $timestamps = true;

    protected $guarded = array();

    protected  $dateFormat = 'U';

    protected $dates = ['created_at'];

}