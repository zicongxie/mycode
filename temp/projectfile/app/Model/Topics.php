<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Topics extends Model {

    protected $table = 'topics';

    public $timestamps = true;

    protected $guarded = array();

    protected  $dateFormat = 'U';

    protected $dates = ['created_at'];

    public function user(){
        return $this->hasOne('App\Model\User','uid','creator_uid');
    }

    public function cate(){
        return $this->hasOne('App\Model\TopicCategories','id','cid');
    }

    public function show(){
        return $this->hasMany('App\Model\TopicsShow','topic_id','id');
    }

}
