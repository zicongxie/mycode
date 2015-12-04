<?php
/**
 * Created by PhpStorm.
 * User: lyt8384
 * Date: 2015/11/11
 * Time: 17:46
 */

namespace App\Helper;


use Illuminate\Support\Facades\Config;

class Image {

    /**
     * 根据图片编号返回图片链接。
     * @param $code_id
     * @return string
     */
    public static function makeImage($code_ids)
    {
        $code_ids = explode(',', $code_ids);

        if (empty($code_ids)) {
            return FALSE;
        }

        foreach ($code_ids as $key => $code_id) {

            $timestamp = self::dec10(substr($code_id , 0 , 6));
            $image_id = self::dec10(substr($code_id , 6 , 4));

            $img_type = substr($image_id , 0 , 1);
            $img_rand = substr($image_id , 1 , 6);
            $img_host = Config::get('app.img_host');
            switch ($img_type)
            {
                case 1:
                    $img_type = '.jpg';
                    break;
                case 2:
                    $img_type = '.png';
                    break;
                case 3:
                    $img_type = '.gif';
                    break;
                default:
                    $img_type = '';
            }

            $image_urls[] = $img_host . date("/Ym/d/His",$timestamp) . dechex($img_rand) . $img_type;

        }

        if (count($image_urls) > 1) {
            return $image_urls;
        } else {
            return current($image_urls);
        }

    }

    /**
     * 根据设备决定输出图片
     * @param $img
     * @param string $type
     * @return array|mixed
     */
    public static function showImg($img,$type = '')
    {
        if(!is_array($img))
            $img = [$img];

        $out =[];
        foreach($img as $v) {
            //TODO:根据设备决定输出
            $out[] = $v;
        }

        if (count($out) > 1) {
            return $out;
        } else {
            return current($out);
        }
    }

    /**
     * 62进制转10进制
     * @param $num
     * @return bool|int
     */
    private static function dec10($num)
    {
        $from = 62;
        $num = strval($num);
        $dict = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $len = strlen($num);
        $dec = 0;
        for($i = 0; $i < $len; $i++) {
            $pos = strpos($dict, $num[$i]);
            $dec = bcadd(bcmul(bcpow($from, $len - $i - 1), $pos), $dec);
        }
        return $dec;
    }

    /**
     * 10进制转62进制
     * @param $n
     * @return string
     */
    private function dec62($num) {
        $base = 62;
        $index = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $ret = '';
        for($t = floor(bcdiv(log10($num) , log10($base),1)); $t >= 0; $t --) {
            $a = floor(bcdiv($num , bcpow($base, $t),1));
            $ret .= substr($index, $a, 1);
            $num = bcsub($num , bcmul($a , bcpow($base, $t)));
        }
        return $ret;
    }
}