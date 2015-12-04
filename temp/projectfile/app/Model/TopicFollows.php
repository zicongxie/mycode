<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TopicFollows extends Model {

    protected $table = 'topic_follows';

    public $timestamps = true;

    protected $guarded = array();

    protected  $dateFormat = 'U';

    protected $dates = ['created_at'];

    public $relationships = array('Topics');

	public function topics() {
        return $this->hasOne('App\Model\Topics', 'id', 'topic_id');
	}

}