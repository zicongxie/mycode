<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserRecommend extends Model
{
    protected $table = 'user_recommend';

    protected $dateFormat = 'U';

    protected $fillable = ['uid', 'admin_uid', 'type', 'rank'];

    public function users()
    {
        return $this->belongsTo('App\Model\User', 'uid', 'uid');
    }
}
