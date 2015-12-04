<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserLoginLog extends Model
{
    protected $table = 'user_login_log';

    protected $dateFormat = 'U';

    public $timestamps = true;

    protected $guarded = array();
}
