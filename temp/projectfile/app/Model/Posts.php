<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model {

    protected $table = 'posts';

    public $timestamps = true;

    protected $guarded = array();

    protected  $dateFormat = 'U';

    protected $dates = ['created_at'];

    public function user(){
        return $this->hasOne('App\Model\User','uid','author_uid');
    }

    public function topics(){
        return $this->hasOne('App\Model\Topics','id','topic_id');
    }
}
