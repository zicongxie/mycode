<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    protected $table = 'reviews';

    public $timestamps = true;

    protected $guarded = array();

    protected  $dateFormat = 'U';

    protected $dates = ['created_at','updated_at'];

    public function user(){
        return $this->hasOne('App\Model\User','uid','author_uid');
    }


    /**
     * 计算给定时间戳与当前时间相差的时间，并以一种比较友好的方式输出
     * @param Int $timestamp 目标计算时间
     * @param Int $current_time   现在时间
     * @return String 相隔时间
     */
    public function transformTimes($timestamp,$current_time=0){
        if(!$current_time) $current_time=time();
        $span=$current_time-$timestamp;
        if($span<60){
            return "刚刚";
        }else if($span<3600){
            return intval($span/60)."分钟前";
        }else if($span<24*3600){
            return intval($span/3600)."小时前";
        }else if($span<(7*24*3600)){
            return intval($span/(24*3600))."天前";
        }else{
            return date('Y-m-d',$timestamp);
        }
    }
}
