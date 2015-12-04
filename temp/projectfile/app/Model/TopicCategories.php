<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TopicCategories extends Model
{
    protected $table = 'topic_categories';

    protected $guarded = array();

    protected  $dateFormat = 'U';
}
