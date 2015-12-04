<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $table = 'settings';

    protected $dateFormat = false;

    protected $primaryKey = 'settings_key';
}
