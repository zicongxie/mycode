<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class ApiVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //TODO:强制检测请求类型是否为JSON

        $in_content = $request->getContent();
        $device_id = $request->input('device_id');

        Redis::publish('test_log',$in_content);
        //TODO:输入前面

        if($request->input('in_encrypt') == 'RAS'){
            //TODO:输入解码
        }

        //处理逻辑
        $ret = $next($request);

        $out_content = $ret->content();
        Redis::publish('test_log', $out_content);
        //内容是否要加密返回
        if($request->input('out_encrypt') == 'RAS'){
            $pi_key = openssl_pkey_get_private(Storage::disk('local')->get('Keys/content_private_key.pem'));
            $lenght = ceil(strlen($out_content) / 100);
            $out_ras = [];
            for($i=0;$i<$lenght;$i++)
                openssl_private_encrypt(substr($out_content,$i * 100, 100),$out_ras[$i],$pi_key);

            $ret->setContent(implode('',$out_ras))
                ->header('Content-Type', 'text/binary');
        }

        return $ret;
    }
}
