<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserConnect extends Model
{
    protected $table = 'user';

    protected $dateFormat = 'U';

    protected $primaryKey = 'id';

    protected $guarded = array();
}
