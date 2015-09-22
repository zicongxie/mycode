<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>样板房争霸赛</title>
<meta name="Copyright" content="Copyright (c) 2006-2015 xizi" />
<meta name="renderer" content="webkit">
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="Keywords" content="">
<meta name="Description" content="">
<link href="<?PHP echo ZT_CSS?>common.css?v=12" rel="stylesheet" type="text/css" />
<link href="<?PHP echo ZT_CSS?>detail.css" rel="stylesheet" type="text/css" />
<link href="<?PHP echo ZT_CSS?>layer.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#site_nav {
  background:#dfe0e4 !important;
}
</style>
<script  src="<?PHP echo ZT_JS?>jquery1.9.0.js"></script>
<script  src="<?PHP echo ZT_JS?>layer.js"></script>
<script  src="<?PHP echo ZT_JS?>validform.js"></script>
<script  src="<?PHP echo ZT_JS?>jquery.SuperSlide.2.1.1.js"></script>
<script src="<?PHP echo ZT_JS?>laydate.js"></script>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=pzvWVPZgvHZTflZckRSbapXi"></script>
</head>
<body>
<?php include xz_template('header');?>

<div class="d-main">
    <div class="m-left">
        <div id="slideBox" class="slideBox">
            <div class="hd">
                <ul><!-- n张图n个li -->
                    <?php
                        for ($i=0; $i < $count; $i++) { ?>
                            <li>.</li>
                    <?php
                        }
                    ?>
                </ul>
            </div>
            <div class="bd">
                <ul>
                    <!-- <li style="display: list-item;"><a href="" target="_blank"><img src="<?PHP echo $info['img'][0];?>"></a></li>
                    <li style="display: none;"><a href="" target="_blank"><img src="<?PHP echo $info['img'][1];?>"></a></li>
                    <li style="display: none;"><a href="" target="_blank"><img src="<?PHP echo $info['img'][2];?>"></a></li> -->
                    <?php foreach ($info['img'] as $k => $v) {?>
                        <li style="display: none;"><a href="" target="_blank"><img src="<?PHP echo $v;?>"></a></li>                    
                    <?php
                    }?>
                </ul>
            </div>
			
            <a class="prev" href="javascript:void(0)"></a>
            <a class="next" href="javascript:void(0)"></a>

        </div>
    </div>
    <div class="m-right" id="m-right">
        <div class="m-text-left">
            <h3><?php echo $info['title'];?></h3><br>
            <p>【建筑面积】<?php echo $info['bulidarea'];?>m2</p>
            <p>【使用面积】<?php echo $info['usearea'];?>m2</p> 
            <p>【户型结构】<?php echo $info['housestyle'];?></p>
        </div>
        <div class="brand" style="background: #fff url(<?PHP
                                                            if($info['constrpart'] == 2)echo ZT_IMAGES."1-icon.jpg";
                                                            elseif($info['constrpart'] == 1)echo ZT_IMAGES."2-icon.jpg";
                                                            elseif($info['constrpart'] == 3)echo ZT_IMAGES."3-icon.jpg";
                                                            ?>) no-repeat center 24px;">
            <span>关注人气：<?php echo $readcount[0]['readcount'];?></span>
        </div>
        <div class="m-text-center">
            <p>【施工单位】<?php 
                                switch ($info['constrpart']) {
                                    case '1':
                                        echo "蜗居装饰";
                                        break;
                                    case '2':
                                        echo "易百装饰";
                                        break;
                                    case '3':
                                        echo "华宁装饰";
                                        break;
                                    case '4':
                                        echo "三星装饰";
                                        break;
                                    case '5':
                                        echo "皇城装饰";
                                        break;                                  
                                }
                            ?>
            </p>
            <p>【主要材料】<?php echo $info['material'];?></p>
            <p>【项目造价】<?php echo $info['price'];?></p>
        </div>
        <p>标签   <?php echo $info['tag'];?></p>
        <p>地址   <span id="get-add">获取联系方式和地址（免费）</span><span class="p-phone-span">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span><a href="#hd" id="view-map">查看地图</a></span><span class="p-map-span">&nbsp;&nbsp;&nbsp;&nbsp;</p>
        <!-- hide form -->
<!--         <form action="" class="get-form" id="get-form" name="myform">       
    <label for="">名字</label><input type="text" placeholder="留下您的名字" name="name" datatype="*" nullmsg="名字不能为空"><br>
    <label for="">手机</label><input type="text" placeholder="留下您的手机号码" name="phone" datatype="m" nullmsg="请填写11位手机号码"><br>
    <input type="submit" class="get-sub" value="免费获取"  />   
</form> -->
        <a href="javascript:;" class="p-apply-a" >报名参赛</a>
        <a href="javascript:;" class="p-book-a">预约看样板房</a>
    </div>
</div>

<!-- tag -->
<div class="tag" >
    <div class="slideTxtBox">
        <div class="hd" id="hd">
            <ul id="s-hd"><li>样板房介绍</li><li>施工工艺</li><li>基础材料</li><li>特色服务</li><li id="bmap">交通地图</li></ul>
        </div>
        <div class="bd" id="bd">
            <!-- tag1 start -->
            <ul class="h-introduce">
                <div class="tag-title">样板房介绍</div> 
                <hr>  
                <div class="tag-content">
                    <?php echo $info['content'];?>
                </div>
            </ul>
            <!-- tag2 start -->
            <ul class="h-introduce">
                <div class="tag-title">施工工艺</div> 
                <hr>  
                <div class="tag-content">
                    <?php echo $shopsDetail['craftwork'];?>
                </div>    
            </ul>
            <!-- tag3 start -->
            <ul class="h-introduce">
                <div class="tag-title">基础材料</div> 
                <hr>  
                <div class="tag-content">
                    <?php echo $shopsDetail['basematerial'];?>
                </div>    
            </ul>
            <!-- tag4 start -->
            <ul class="h-introduce">
                <div class="tag-title">特色服务</div> 
                <hr>  
                <div class="tag-content">
                    <?php echo $shopsDetail['service'];?>
                </div>    
            </ul>
            <!-- tag5 start -->
            <ul class="h-introduce">
                <div class="tag-title" >交通地图</div> 
                <hr>  
                <div class="tag-content" >
                     <div id="allmap"></div>
                </div>    
            </ul>


        </div>
    </div>
</div>
<div class="re-top" id="re-top"></div><!-- comeback -->
<div id="shadow">
</div>
<!-- output for sub -->
<div class="output" id="output">
        <form action="?a=ajax_sign&i=3" class="sub-form" name="myform"  method="post">
        <div class="form-title">本活动已有<?php echo $signCount;?>网友报名 <a href="javascript:;" id="close" class="close" ><img src="<?PHP echo ZT_IMAGES?>close.png" /></a></div>
                    <div class="form-control">
                <label>您的名字</label>
                <input type="text" class="inp-text" name="info[name]" placeholder="请填写您的名字" datatype="*" nullmsg="名字不能为空" />
            </div>
            <div class="form-control">
                <label>您的手机</label>
                <input type="text" class="inp-text" name="info[phone]" placeholder="请填写您的手机" datatype="m" nullmsg="请填写11位手机号码"/>
            </div>
            <div class="form-control">
                <label>小区名称</label>
                <input type="text" class="inp-text" name="info[areaname]" placeholder="请填写您的小区名" datatype="*" nullmsg="小区名不能为空"/>
            </div>
            <div class="form-control">
                <label><pre style="display:inline;font-family:microsoft YaHei;">面       积</pre></label>
                <input type="text" class="inp-text inp-text-m " name="info[usearea]"placeholder="请填写您的房子面积" datatype="n" nullmsg="请填写房子面积"  />
                <span class="sub-span">㎡</span>
            </div>
            <div class="btn-submit" >
                <input type="submit" class="inp-submit" name="sub"  value="报名参赛"/>
            </div>
    </form>
</div>
<!-- output for book -->
<div class="output" id="output1">
        <form action="?a=ajax_order&k=1&x=<?php echo $info['constrpart'];?>&y=<?php echo $info['title'];?>" class="sub-form" name="myform"  method="post">
        <div class="form-title">本样板房已有<?php echo $info['order'];?>位网友预约参观 <a href="javascript:;" id="b-close" class="close" ><img src="<?PHP echo ZT_IMAGES?>close.png" /></a></div>
            <div class="form-control">
                <label>*您的名字</label>
                <input type="text" class="inp-text" name="info[name]" placeholder="请填写您的名字" datatype="*" nullmsg="名字不能为空" />
            </div>
            <div class="form-control">
                <label>*您的手机</label>
                <input type="text" class="inp-text" name="info[phone]" placeholder="请填写您的手机" datatype="m" nullmsg="请填写11位手机号码"/>
            </div>
            <div class="form-control">
                <label>&nbsp;免费预约 </label>
                <input type="text" class="inp-text" name="info[date]" placeholder="请填写您要预约的日期" datatype="*" nullmsg="预约的日期不能为空" class="laydate-icon" onfocus="laydate()"/>
            </div>
            <div class="btn-submit" >
                <input type="submit" class="inp-submit" name="sub"  value="免费预约"/>
            </div>
    </form>
</div>


<div class="shadow-show" id="shadow-show">
    <div><a href="javascript:;" id="close" class="r-close" ><img src="<?PHP echo ZT_IMAGES?>close.png" /></a></div>
    <div class="show-center"><img src="<?PHP echo ZT_IMAGES?>true.png"></div>
    <p class="show-larfont">恭喜您！信息提交成功</p>
    <p>感谢你的报名，家居客服会尽快与您取得联系！</p>
</div>
<div class="shadow-show" id="shadow-error">
    <div><a href="javascript:;" id="close" class="r-close" ><img src="<?PHP echo ZT_IMAGES?>close.png" /></a></div>
    <div class="show-center"><img src="<?PHP echo ZT_IMAGES?>false.png"></div>
    <p class="show-larfont">报名失败！请重新操作</p>
</div>
<div class="shadow-show" id="shadow-b-true">
    <div><a href="javascript:;" id="close" class="r-close" ><img src="<?PHP echo ZT_IMAGES?>close.png" /></a></div>
    <div class="show-center"><img src="<?PHP echo ZT_IMAGES?>true.png"></div>
    <p class="show-larfont">恭喜您！信息提交成功</p>
    <p>感谢你的预约，家居客服会尽快与您取得联系！</p>
</div>

<script type="text/javascript">
//遮罩层
    window.onload=function(){
        var close=document.getElementById('close');
        var bClose=document.getElementById('b-close');
        var shadow=document.getElementById('shadow');
        var shadowShow=document.getElementById('shadow-show');
        var output=document.getElementById('output');
        var output1=document.getElementById('output1');
        var hl=document.getElementById('m-right');
        var apply=getByClass(hl,'p-apply-a');
        var book=getByClass(hl,'p-book-a');
            apply[0].onclick=function(){
                shadow.style.display='block';
                output.style.display='block';
            };
            book[0].onclick=function(){
                shadow.style.display='block';
                output1.style.display='block';
            };
        shadow.onclick=close.onclick=bClose.onclick=function(){
        shadow.style.display='none';
        output.style.display='none';
        output1.style.display='none';
        };

        //view-map button
        var sHd=document.getElementById('s-hd');
        var oLi=sHd.getElementsByTagName('li');
        var oBd=document.getElementById('bd');
        var oUl=oBd.getElementsByTagName('ul');
        document.getElementById('view-map').onclick=function(){
            for (var j = 0; j < oLi.length; j++) {
                 oLi[j].className='';
             }
                 oLi[j-1].className='on';
            for (var j = 0; j < oUl.length; j++) {
                 oUl[j].style.display='none';
             } 
             oUl[j-1].style.display='block';
             getBaiduMap();
        };

        //Getting phone numbers and address
/*        var getAdd=document.getElementById('get-add');
        var getForm=document.getElementById('get-form');     
        var timer1=null,timer2=null;
        getAdd.onclick=function(){getForm.style.display='block';};
        getAdd.onmouseout=function(){
            timer1=setTimeout(function(){            
                getForm.style.display='none'; 
            },500);
        };
        getForm.onmouseout=function(){
            timer2=setTimeout(function(){
               getForm.style.display='none'; 
            },3000);
        };
        getForm.onmouseover=function(){
            clearTimeout(timer1);
            clearTimeout(timer2);
        };*/
/*        getAdd.onclick=function(){    
           layer.msg('获取成功！',{
                time:300000000,
                fix:true
            });

        }; */
    //comeback top
            var oRe=document.getElementById('re-top'),
            scrollTop,timer=null,state=true,
            viewWidth=document.documentElement.clientWidth;
                oRe.style.right=(viewWidth-1000)/2-80+'px';
            window.onresize=function(){
                viewWidth=document.documentElement.clientWidth;
                oRe.style.right=(viewWidth-1000)/2-80+'px';
            };
        window.onscroll=function(){
            scrollTop=document.documentElement.scrollTop||document.body.scrollTop;
            if (scrollTop>300) oRe.style.display='block';
            else oRe.style.display='none';
          /*  if (!state){clearInterval(timer)};
            state=false;*/
        };
        oRe.onclick=function(){
            clearInterval(timer);
            timer=setInterval(function(){
                scrollTop=document.documentElement.scrollTop||document.body.scrollTop;
                if (Math.floor(scrollTop)<=0){
                    clearInterval(timer);
                }else{
                    document.body.scrollTop-=(document.body.scrollTop)/5;
                    document.documentElement.scrollTop-=(document.documentElement.scrollTop)/5;
                // state=false;   
                }
            },30);
        };


                
    };
$(function(){
    //validform for  sub
    var form = $(".sub-form"),
        shadow=$('#shadow'),
        shadowShow=$('#shadow-show'),
        output1=$('#output1'),
        output=$('#output'),
        shadowError=$('#shadow-error'),
        shadowBTrue=$('#shadow-b-true');
form.Validform({
    tipSweep:true,
    tiptype:function(msg,o,cssctl){
        if (o.type == 3) {
            layer.tips(msg,o.obj,{
                tips:[1,'#ff7e00'],
                time:1000
            });
        };
    },  
    ajaxPost:true,
    callback:function(data){
        if (data.error == 0) {             //sub true
            output.hide();
            shadow.show();
            shadowShow.show();
            setTimeout(function(){
            shadow.hide('slow');
            shadowShow.hide('slow');  
            },2000);
            form[0].reset();
        }else if(data.error == -2){        //sub false
            output.hide();
            shadow.show();
            shadowError.show();
            setTimeout(function(){
            shadowError.hide('slow');
            shadow.hide();  
            output.show();
            },1000);
        }else if(data.error == 1){
            output1.hide();
            shadow.show();
            shadowBTrue.show();
            setTimeout(function(){
            shadow.hide('slow');
            shadowBTrue.hide('slow');  
            },2000);
            form[1].reset();
        }else if(data.error == -3){
            output1.hide();
            shadow.show();
            shadowError.show();
            setTimeout(function(){
            shadowError.hide('slow');
            output1.show();  
            },1000);            
        }

    },  

});

//close shadow-show
    $('.r-close').click(function(){
        shadow.hide('slow');
        $('.shadowShow').hide('slow');
    });
});
//slide
jQuery(".slideBox").slide({mainCell:".bd ul",autoPlay:true});
//tag
jQuery(".slideTxtBox").slide();

//stay top
// $("#s-hd").scrollFix("top","top");


    var oBmap=document.getElementById('bmap');
     // 百度地图API功能
    var map = new BMap.Map("allmap");
    var point = new BMap.Point(114.4248820000,23.1189930000);
    // 创建地址解析器实例
    var myGeo = new BMap.Geocoder();
    map.centerAndZoom(point,16);  
    oBmap.onmouseout=getBaiduMap;

   
function getBaiduMap(){
    // 将地址解析结果显示在地图上,并调整地图视野
    myGeo.getPoint("<?php echo $info['address'];?>", function(point){
        if (point) {
            map.centerAndZoom(point, 16);
            map.addOverlay(new BMap.Marker(point));
        }else{
            // alert("您选择地址没有解析到结果!");
        }
    }, "惠州市");    
}

function getByClass(oParent,fClass1){
    var oEle=oParent.getElementsByTagName('*');
    var oResult=[];
    for(i=0;i<oEle.length;i++){
        if(oEle[i].className==fClass1){
            oResult.push(oEle[i]);
        }
    }
    return oResult;
}

</script>
<div class="b-bottom"></div>
</body>
</html>