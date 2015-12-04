<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AdvertPosition extends Model
{
    protected $table = 'advert_position';

    protected $dateFormat = 'U';

    protected $fillable = ['id', 'title', 'alias', 'max', 'fields'];

    public function adverts()
    {
        return $this->hasMany('App\Model\Adverts', 'position_id');
    }
}
