<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserBanLog extends Model
{
    protected $table = 'user_ban_log';

    protected $dateFormat = 'U';

    protected $fillable = ['uid', 'admin_uid', 'description', 'end_at', "time"];

    protected $datas = ['end_at'];

    public function user()
    {
        return $this->belongsTo('App\Model\User', 'uid', 'uid');
    }
}
