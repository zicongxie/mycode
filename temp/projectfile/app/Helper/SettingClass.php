<?php
/**
 * Created by PhpStorm.
 * User: lyt8384
 * Date: 2015/11/30
 * Time: 9:39
 */

namespace App\Helper;


use App\Model\Settings;

class SettingClass
{
    /**
     * @param $property
     * @return bool|string
     */
    public function __get($property)
    {
        $setting = Settings::find($property);
        return $setting->value
            ? $setting->value
            :false;
    }
}