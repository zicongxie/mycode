<?php
/**
 * Created by PhpStorm.
 * User: lyt8384
 * Date: 2015/11/30
 * Time: 9:25
 */

namespace App\Http\Controllers\Api\System;

use App\Http\Controllers\Api\ApiBaseController;
use Illuminate\Http\Request;
use App\Model\Advert;
use App\Model\AdvertPosition;
use App\Helper\Image;

class AdvertController extends ApiBaseController
{
    /**
     * 开机广告
     * @return json
     */
    public function postLaunchAd(Request $request)
    {
        $pid = intval($this->setting->launch_ad_pid);
        $return = [];
        if($pid != 0 && $position = AdvertPosition::find($pid)){
            $adverts = Adverts::where('position_id', $position->id)->where('start_at','<', time())->where('end_at', '>', time())->take($position->max)->get()->toArray();
            if($adverts){
                foreach ($adverts as $key => $advert) {
                    //默认展示时间
                    $advert_data = json_decode($advert['advert_data'], true);
                    if(isset($advert_data['duration'])){
                        $adverts[$key]['duration'] = $advert_data['duration'];
                    }
                    else{
                        $default_duration = $this->setting->launch_ad_duration;
                        $adverts[$key]['duration'] = $default_duration ?$default_duration : 3;
                    }
                    $adverts[$key]['image'] = Image::showImg($adverts[$key]['image']);
                }
                $return = $adverts;
            }
        }
        return response()->api($return);
    }
}