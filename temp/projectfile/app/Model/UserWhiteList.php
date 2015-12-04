<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserWhiteList extends Model
{
    protected $primaryKey = 'uid';
    protected $table = 'user_white_list';

    protected $dateFormat = 'U';

    protected $fillable = ['uid', 'admin_uid', 'description'];

    public function users()
    {
        return $this->belongsTo('App\Model\User', 'uid', 'uid');
    }
}
