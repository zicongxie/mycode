<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use App\Helper\Image;
class Test extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->api([
            'a'=>1,
            'b'=>'2',
            'c'=>false,
            'd'=>true,
            'e'=>null,
            'arr'=>[
                'a'=>1,
                'b'=>'2',
                'c'=>false,
                'd'=>true,
                'e'=>1447061142,
                'n0'=>$this->dec62(2111111),
                'n1'=>$this->dec62(1447061142),
                'n2'=>$this->dec62(9999999),
                'n3'=>$this->dec10($this->dec62('9999999999144705880199999999999')),
                'n4'=>$this->dec10('1zVIHQ4F39'),
                'img'=>Image::makeImage('1zVIHQ4F39'),
                'img2'=>Image::makeImage('1zVIHQ8Rcb'),
            ],
            'config'=> Config::get('app.img_host')
        ]);
    }

    private function dec62($n) {
        $base = 62;
        $index = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $ret = '';
        for($t = floor(log10($n) / log10($base)); $t >= 0; $t --) {
            $a = floor(bcdiv($n , bcpow($base, $t),1));
            $ret .= substr($index, $a, 1);
            $n = bcsub($n , bcmul($a , bcpow($base, $t)));
        }
        return $ret;
    }

    private function dec10($num)
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
