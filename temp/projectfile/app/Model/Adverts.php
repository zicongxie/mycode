<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Adverts extends Model
{
    protected $table = 'adverts';

    protected $dateFormat = 'U';

    protected $fillable = ['id', 'position_id', 'title', 'description', 'image', 'push_cid', 'type', 'sort', 'advert_data', 'start_at', 'end_at', 'pv', 'admin_uid'];

    public function position()
    {
        return $this->belongsTo('App\Model\AdvertPosition', 'id', 'position_id');
    }
}
