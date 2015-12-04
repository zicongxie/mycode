<?php

namespace App\Http\Controllers\Admin\Advert;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Model\Adverts;
use App\Model\AdvertPosition;
use Illuminate\Support\Facades\Auth;
use Request;
use App\Model\LocationData;
use App\Model\TopicCategories;
use App\Helper\UserHelper;
use App\Http\Requests;
use App\Helper\Image;

 class AdvertController extends AdminBaseController
{

    public function getAdvertLists(){
        return view('admin.ad.list_ad');
    }

    public function getAddAdvert(){
        return view('admin.ad.edit_ad');
    }

    public function getAddAdvertPosition(){
        return view('admin.ad.edit_ad_cate');
    }

    public function getAdvertPositions(){
        return view('admin.ad.list');
    }
}