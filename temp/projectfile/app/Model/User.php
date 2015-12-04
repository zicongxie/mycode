<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    const CREATED_AT = 'reg_time';

    protected $table = 'user';

    protected $dateFormat = 'U';

    protected $dates = ['reg_time', 'updated_at'];

    protected $primaryKey = 'uid';

    //protected $fillable = ['is_lock'];

    protected $guarded = array();

    public function scopeLocked($query)
    {
        $query->where('is_lock',1);
    }

    public function banLogs()
    {
        return $this->hasMany('App\Model\UserBanLog', 'uid', 'uid');
    }
}
