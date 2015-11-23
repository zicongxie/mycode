<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;">
<title><?php echo $page_title;?></title>
<meta name="Copyright" content="Copyright (c) 2006-2015 xizi" />
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="Keywords" content="">
<meta name="Description" content="">
<link href="<?PHP echo ZT_CSS?>common.css?v=123" rel="stylesheet" type="text/css" />
<link href="<?PHP echo ZT_CSS?>style.css?v=1234" rel="stylesheet" type="text/css" />
<link href="<?PHP echo ZT_CSS?>layer.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#site_nav {
  background:#dfe0e4 !important;
}
</style>
<script type="text/javascript" src="<?PHP echo ZT_JS?>jquery1.9.0.js"></script>
<script type="text/javascript" src="<?PHP echo ZT_JS?>layer.js"></script>
<script type="text/javascript" src="<?PHP echo ZT_JS?>validform.js"></script>
<script src="<?PHP echo ZT_JS?>laydate.js"></script>
</head>
<body>
<?php include xz_template('header');?>
<div class="g-describe">
    <div class="game-specil">
        <div class="spe-title">大赛特色</div>
        <ul>
            <div class="g-li">
                <li class="l-left">1</li><li class="l-right"><span class="g-span-color">和别人花一样的钱，装出样板房的效果</span>，完工实景还能参加比赛，有机会拿大奖哦；</li>
            </div>
            <div class="g-li">
                <li class="l-left">2</li><li class="l-right">参与一个活动，同时有可能获得两份大奖——装修日记大赛，样板房设计大赛， <span class="g-span-color">奖品总价值过万</span>；</li>
            </div>
            <div class="g-li">
                <li class="l-left">3</li><li class="l-right">业主和装饰公司是团队关系，我们的共同目标是，业主工地能拿<span class="g-span-color">最美样板房设计大奖，施工方能拿网络最受欢迎装饰公司大奖;</span></li>
            </div>
            <div class="g-li">
                <li class="l-left">4</li><li class="l-right">4.每个装饰公司都为参赛业主备下厚礼，争霸赛获奖者<span class="g-span-color">还可获得施工装饰公司的特别奖励</span>（详见样板房案例之【特色服务】）</li>
            </div>
            <div class="g-li">
                <li class="l-left">5</li><li class="l-right">5.每个装修工地都会组成“业主-装饰公司-西子家居”三方微信互动小组，<span class="g-span-color">实时交流工地进展，监督工地实况，让装修真省心！</span></li>
            </div>
        </ul>   
    </div>
    <div class="game-sub">
        <div class="gam-title">30秒快速报名 <span>已有1915位网友报名</span></div>
        <form action="?a=ajax_sign&i=1" class="sub-form" name="myform"  method="post">
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
</div>

<div class="home-list">
    <div class="h-title">
        <img src="<?PHP echo ZT_IMAGES?>h_view.png" />
    </div>
    <ul id="hl-ul">
    <?php foreach ($infos1 as $key => $val):?>
        <dl>
            <dt><a href="?a=detail&id=<?php echo $infos1[$key]['id'];?>"><img src="<?php echo $infos1[$key]['thumb'];?>"></a></dt>
            <dd class="hl-dd1"><?php echo $infos1[$key]['bulidname'];?><?php $n = strpos($infos1[$key]['tag'], ' ');$str=substr($infos1[$key]['tag'], 0, $n);if($str){echo "｜".$str;}elseif($infos1[$key]['tag']){echo "｜".$infos1[$key]['tag'];}?><?php if($infos1[$key]['usearea']) echo "｜".$infos1[$key]['usearea']."㎡"?><?php if($infos1[$key]['freeprice']) echo "｜".$infos1[$key]['freeprice'];?><?php if($infos1[$key]['designprice']) echo "｜".$infos1[$key]['designprice'];?><div class="hl-dd-f-right"><img src="<?PHP echo ZT_IMAGES?>eye.png" /> <?php $no = $infos1[$key]['no']; echo $readnum[$no] + $infos1[$key]['readnum'];?></div>
            </dd>
            <input type="hidden" class="y_id" value="<?php echo $infos1[$key]['id']; ?>">
            <input type="hideen" class="order_num" value="<?php echo $infos1[$key]['order'];?>" style="display:none">
            <dt class="h-dt-bottom"><div class="h-t-div1"><?php 
                                                            switch ($infos1[$key]['constrpart']) {
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
                                                          ?>设计</div><div class="h-t-div2" >预约参观</div></dt>
        </dl>
    <?php endforeach;?>
    <?php foreach ($infos2 as $key => $val):?>
        <dl>
            <dt><a href="?a=detail&id=<?php echo $infos2[$key]['id'];?>"><img src="<?php echo $infos2[$key]['thumb'];?>"></a></dt>
            <dd class="hl-dd1"><?php echo $infos2[$key]['bulidname'];?><?php $n = strpos($infos2[$key]['tag'], ' ');$str=substr($infos2[$key]['tag'], 0, $n);if($str){echo "｜".$str;}elseif($infos2[$key]['tag']){echo "｜".$infos2[$key]['tag'];}?><?php if($infos2[$key]['usearea']) echo "｜".$infos2[$key]['usearea']."㎡"?><?php if($infos2[$key]['freeprice']) echo "｜".$infos2[$key]['freeprice'];?><?php if($infos2[$key]['designprice']) echo "｜".$infos2[$key]['designprice'];?><div class="hl-dd-f-right"><img src="<?PHP echo ZT_IMAGES?>eye.png" /> <?php $no = $infos2[$key]['no']; echo $readnum[$no] + $infos2[$key]['readnum'];?></div>
            </dd>
            <input type="hidden" class="y_id" value="<?php echo $infos2[$key]['id']; ?>">
            <input type="hideen" class="order_num" value="<?php echo $infos2[$key]['order'];?>" style="display:none">
            <dt class="h-dt-bottom"><div class="h-t-div1"><?php 
                                                            switch ($infos2[$key]['constrpart']) {
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
                                                          ?>设计</div><div class="h-t-div2" >预约参观</div></dt>
        </dl>
    <?php endforeach;?>
    <?php foreach ($infos3 as $key => $val):?>
        <dl>
            <dt><a href="?a=detail&id=<?php echo $infos3[$key]['id'];?>"><img src="<?php echo $infos3[$key]['thumb'];?>"></a></dt>
            <dd class="hl-dd1"><?php echo $infos3[$key]['bulidname'];?><?php $n = strpos($infos3[$key]['tag'], ' ');$str=substr($infos3[$key]['tag'], 0, $n);if($str){echo "｜".$str;}elseif($infos3[$key]['tag']){echo "｜".$infos3[$key]['tag'];}?><?php if($infos3[$key]['usearea']) echo "｜".$infos3[$key]['usearea']."㎡"?><?php if($infos3[$key]['freeprice']) echo "｜".$infos3[$key]['freeprice'];?><?php if($infos3[$key]['designprice']) echo "｜".$infos3[$key]['designprice'];?><div class="hl-dd-f-right"><img src="<?PHP echo ZT_IMAGES?>eye.png" /> <?php $no = $infos3[$key]['no']; echo $readnum[$no] + $infos3[$key]['readnum'];?></div>
            </dd>
            <input type="hidden" class="y_id" value="<?php echo $infos3[$key]['id']; ?>">
            <input type="hideen" class="order_num" value="<?php echo $infos3[$key]['order'];?>" style="display:none">
            <dt class="h-dt-bottom"><div class="h-t-div1"><?php 
                                                            switch ($infos3[$key]['constrpart']) {
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
                                                          ?>设计</div><div class="h-t-div2" >预约参观</div></dt>
        </dl>
    <?php endforeach;?>
    <?php foreach ($infos4 as $key => $val):?>
        <dl>
            <dt><a href="?a=detail&id=<?php echo $infos4[$key]['id'];?>"><img src="<?php echo $infos4[$key]['thumb'];?>"></a></dt>
            <dd class="hl-dd1"><?php echo $infos4[$key]['bulidname'];?><?php $n = strpos($infos4[$key]['tag'], ' ');$str=substr($infos4[$key]['tag'], 0, $n);if($str){echo "｜".$str;}elseif($infos4[$key]['tag']){echo "｜".$infos4[$key]['tag'];}?><?php if($infos4[$key]['usearea']) echo "｜".$infos4[$key]['usearea']."㎡"?><?php if($infos4[$key]['freeprice']) echo "｜".$infos4[$key]['freeprice'];?><?php if($infos4[$key]['designprice']) echo "｜".$infos4[$key]['designprice'];?><div class="hl-dd-f-right"><img src="<?PHP echo ZT_IMAGES?>eye.png" /> <?php $no = $infos4[$key]['no']; echo $readnum[$no] + $infos4[$key]['readnum'];?></div>
            </dd>
            <input type="hidden" class="y_id" value="<?php echo $infos4[$key]['id']; ?>">
            <input type="hideen" class="order_num" value="<?php echo $infos4[$key]['order'];?>" style="display:none">
            <dt class="h-dt-bottom"><div class="h-t-div1"><?php 
                                                            switch ($infos4[$key]['constrpart']) {
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
                                                          ?>设计</div><div class="h-t-div2" >预约参观</div></dt>
        </dl>
    <?php endforeach;?>
    <?php foreach ($infos5 as $key => $val):?>
        <dl>
            <dt><a href="?a=detail&id=<?php echo $infos5[$key]['id'];?>"><img src="<?php echo $infos5[$key]['thumb'];?>"></a></dt>
            <dd class="hl-dd1"><?php echo $infos5[$key]['bulidname'];?><?php $n = strpos($infos5[$key]['tag'], ' ');$str=substr($infos5[$key]['tag'], 0, $n);if($str){echo "｜".$str;}elseif($infos5[$key]['tag']){echo "｜".$infos5[$key]['tag'];}?><?php if($infos5[$key]['usearea']) echo "｜".$infos5[$key]['usearea']."㎡"?><?php if($infos5[$key]['freeprice']) echo "｜".$infos5[$key]['freeprice'];?><?php if($infos5[$key]['designprice']) echo "｜".$infos5[$key]['designprice'];?><div class="hl-dd-f-right"><img src="<?PHP echo ZT_IMAGES?>eye.png" /> <?php $no = $infos5[$key]['no']; echo $readnum[$no] + $infos5[$key]['readnum'];?></div>
            </dd>
            <input type="hidden" class="y_id" value="<?php echo $infos5[$key]['id']; ?>">
            <input type="hideen" class="order_num" value="<?php echo $infos5[$key]['order'];?>" style="display:none">
            <dt class="h-dt-bottom"><div class="h-t-div1"><?php 
                                                            switch ($infos5[$key]['constrpart']) {
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
                                                          ?>设计</div><div class="h-t-div2" >预约参观</div></dt>
        </dl>
    <?php endforeach;?>
    </ul>
</div>

<div class="goods" id="goods">
    <div class="go-title">大赛奖品</div>
    <ul>
        <li>
            <img src="<?PHP echo ZT_IMAGES?>g_01.png">
            <dt class="good-m-color">最佳样板房装修冠军（1名）</dt>
            <dd><p>价值约<span class="good-m-color">5500元</span></p><p>樱花吸油烟机+燃气灶两件套 （一套）</p></dd>
        </li>
        <li>
            <img src="<?PHP echo ZT_IMAGES?>g_02.png">
            <dt>最佳样板房装修亚军（1名）</dt>
            <dd><p>价值约<span class="good-m-color">5000元</span></p><p>50英寸4K超高清LED液晶电视（一台）</p></dd>
        </li>
        <li class="good-l-li">
            <img src="<?PHP echo ZT_IMAGES?>g_03.png">
            <dt class="good-m-color2">最佳样板房装修季军（1名）</dt>
            <dd><p>价值约<span class="good-m-color">2500元</span></p><p>松下波轮洗衣机（一台）</p></dd>
        </li>
    </ul> 
    <h4>评选原则:</h4>
    <p>一、施工时，参赛业主须在论坛写【装修日记】记录施工实况，完工后需另开帖发布【争霸赛完工实景】</p>
    <p> &nbsp;（小编可以帮忙拍摄靓靓的实景照哦）</p>  
    <p>二、【装修日记】+【争霸赛完工实景】两个帖子的点击与回复数，占评比的40%</p>  
    <p>三、【争霸赛完工实景】接受网络公开投票，占评比的20%</p>
    <p>四、专业评委小组打分，占评比的40%（评委名单稍后公布）</p>
    <h2>网络投票最具人气样板房（10名）</h2>
    <p>价值约<span class="good-m-color">339元</span> 格兰仕微波炉（各一台）</p>
    <h4 style="display:inline;">评选原则:</h4><p  style="display:inline;">【争霸赛完工实景】接受网络公开投票，有效最高投票前十名</p>
    <h2>2015惠州网络最受欢迎装饰公司（1名）</h2>
    <p>由西子家居颁发荣誉奖牌</p>
    <h4>评选原则：</h4>
    <p>一、本次活动中，未受到网友投诉</p>
    <p>二、获奖案例最多的装饰公司（未受投诉是1，获奖是0，有了1，很多的0才有意义哦！）</p>
</div>

<div class="business">
    <div class="bu-title">合作商家</div>
    <ul>
        <li><a href="#"><img src="<?PHP echo ZT_IMAGES?>cus_1.jpg"></a></li>
        <li><a href="#"><img src="<?PHP echo ZT_IMAGES?>cus_2.jpg"></a></li>
        <li><a href="#"><img src="<?PHP echo ZT_IMAGES?>cus_3.jpg"></a></li>
        <li><a href="#"><img src="<?PHP echo ZT_IMAGES?>cus_4.jpg"></a></li>
    </ul>
</div>

<div class="re-top" id="re-top"></div> <!-- comeback -->
<div id="shadow">
</div>
<!-- output for book -->
<div class="output" id="output1">
        <form action="?a=ajax_order&k=2" class="sub-form" name="myform"  method="post">
        <div class="form-title">本样板房已有<span id="c-num"></span>位网友预约参观 <a href="javascript:;" id="b-close" class="close" ><img src="<?PHP echo ZT_IMAGES?>close.png" /></a></div>
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
            <input type="text" name="id" id="y_val" value="" style="display:none;">
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
$(function(){
//遮罩层
    window.onload=function(){
        var close=document.getElementById('close');
        var bClose=document.getElementById('b-close');
        var shadow=document.getElementById('shadow');
        var shadowShow=document.getElementById('shadow-show');
        var output1=document.getElementById('output1');
        var yVal=document.getElementById('y_val');
        var cNum=document.getElementById('c-num');
        var hl=document.getElementById('hl-ul');
        var book=getByClass(hl,'h-t-div2');
        var yId=getByClass(hl,'y_id');
        var orderNum=getByClass(hl,'order_num');
        for (var i = 0; i < book.length; i++) {
            book[i].index=i;
            book[i].onclick=function(){
                shadow.style.display='block';
                output1.style.display='block';
                yVal.setAttribute('value',yId[this.index].attributes["value"].value);
                cNum.innerHTML=orderNum[this.index].attributes["value"].value;
            };
        };   
        shadow.onclick=close.onclick=bClose.onclick=function(){
        shadow.style.display='none';
        output1.style.display='none';
        };
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
            document.onmousedown=function(){
                clearInterval(timer);
            };
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
    //validform for  sub
    var form = $(".sub-form"),
        shadow=$('#shadow'),
        shadowShow=$('#shadow-show'),
        output1=$('#output1'),
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
            shadow.show();
            shadowShow.show();
            setTimeout(function(){
            shadow.hide('slow');
            shadowShow.hide('slow');  
            },2000);
            form[0].reset();
        }else if(data.error == -2){        //sub false
            shadow.show();
            shadowError.show();
            setTimeout(function(){
            shadowError.hide('slow');
            shadow.hide();  
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

function getByClass(oParent,fClass1,fClass2){
    var oEle=oParent.getElementsByTagName('*');
    var oResult=[];
    for(i=0;i<oEle.length;i++){
        if(oEle[i].className==fClass1 || oEle[i].className==fClass2){
            oResult.push(oEle[i]);
        }
    }
    return oResult;
}

</script>
<div class="b-bottom">
</div>
<?php include xz_template('footer');?>
</body>
</html>