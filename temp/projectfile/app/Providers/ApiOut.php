<?php

namespace App\Providers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Routing\ResponseFactory;

class ApiOut extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(ResponseFactory $factory)
    {
        $factory->macro('api', function ($array, $code = 0, $text = '') use ($factory) {
            $out = [
                'code' => $code,
                'text' => $text,
                'data' => $this->array_str($array)
            ];

            //验证头
            $timestamp = time();
            $out_content = json_encode($out);
            $hash_str = md5($out_content . $timestamp);
            $pi_key = openssl_pkey_get_private(Storage::disk('local')->get('Keys/comm_private_key.pem'));
            openssl_private_encrypt($hash_str,$encrypted,$pi_key);
            $hash = base64_encode($encrypted);

            return $factory->make(json_encode($out),200,[
                'Content-Type'=>'application/json',
                'X-Hash'=>$hash,
                'X-Timestamp'=>$timestamp
            ]);
        });

        /**
         * 将数组里所有类型的数据都转成字符串
         *
         * @param $data
         * @return array|string
         */
        $factory->macro('array_str', function ($data) {
            if(is_object($data)) {
                $data = json_decode( json_encode($data), true);
            }

            //null true false
            if($data === null)
                return 'N;';
            if($data === true)
                return 'T;';
            if($data === false)
                return 'F;';

            if (!is_array($data))
                return strval($data);

            foreach ($data as $key => $val)
            {
                unset($data[$key]);
                $data[$key] = $this->array_str($val);
            }
            return $data;
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
