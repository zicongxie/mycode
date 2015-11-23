<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk">
<title><?php echo $page_title;?></title>
<meta name="Copyright" content="Copyright (c) 2006-2015 xizi" />
<meta name="Keywords" content="">
<meta name="Description" content="">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<link href="<?PHP echo ZT_CSS?>common.css?v=12" rel="stylesheet" type="text/css" />
<link href="<?PHP echo ZT_CSS?>list.css" rel="stylesheet" type="text/css" />
<link href="<?PHP echo ZT_CSS?>layer.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#site_nav {
  background:#dfe0e4 !important;
}
</style>
<script type="text/javascript" src="<?PHP echo ZT_JS?>jquery1.9.0.js"></script>
<script type="text/javascript" src="<?PHP echo ZT_JS?>layer.js"></script>
<script type="text/javascript" src="<?PHP echo ZT_JS?>validform.js"></script>
</head>
<body>
<?php include xz_template('header');?>

 <div class="home-list">
    <ul id="hl-ul">
    <?php foreach ($infos as $key => $val):?>
        <dl>
            <dt><a href="?a=detail&id=<?php echo $infos[$key]['id'];?>"><img src="<?php echo $infos[$key]['thumb'];?>"></a></dt>
            <dd class="hl-dd1"><?php echo $infos[$key]['title'];?><?php $n = strpos($infos[$key]['tag'], ' ');$str=substr($infos[$key]['tag'], 0, $n);if($str){echo "｜".$str;}elseif($infos[$key]['tag']){echo "｜".$infos[$key]['tag'];}?><?php if($infos[$key]['usearea']) echo "｜".$infos[$key]['usearea']."㎡"?><?php if($infos[$key]['freeprice']) echo "｜".$infos[$key]['freeprice'];?><?php if($infos[$key]['designprice']) echo "｜".$infos[$key]['designprice'];?><div class="hl-dd-f-right"><img src="<?PHP echo ZT_IMAGES?>eye.png" /> <?php $no = $infos[$key]['no']; echo $readnum[$no] + $infos[$key]['readnum'];?></div>
            </dd>
            <dt class="h-dt-bottom"><div class="h-t-div1"><?php 
                                                            switch ($infos[$key]['constrpart']) {
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
                                                          ?>设计</div><div class="h-t-div2" >报名参赛</div></dt>
            <dd class="hl-dd2"><?php echo "促销：  设计费";echo $infos[$key]['designprice']." 免费施工监理";?></dd>
        </dl>
        <?php endforeach;?>     
    </ul>
</div> 
<div class="re-top" id="re-top"></div> <!-- comeback -->
<!-- hide -->
<div id="shadow">
</div>
<div class="output" id="output">
        <form action="?a=ajax_sign&i=2" class="sub-form" name="myform"  method="post">
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
<!-- hide -->

<!-- 分页 -->
<div class="page">
<?php echo $pages;?>
</div>



<script type="text/javascript">
    window.onload=function(){
        var close=document.getElementById('close');
        var shadow=document.getElementById('shadow');
        var shadowShow=document.getElementById('shadow-show');
        var output=document.getElementById('output');
        var hl=document.getElementById('hl-ul');
        var sub=getByClass(hl,'h-t-div2','h-t-div3');
        for (var i = 0; i < sub.length; i++) {
            sub[i].onclick=function(){
                shadow.style.display='block';
                output.style.display='block';
            };
        };
        shadow.onclick=close.onclick=function(){
        shadow.style.display='none';
        output.style.display='none';
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
        output=$('#output'),
        shadowError=$('#shadow-error');
    //validform
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
        if (data.error==0) {
            output.hide();
            shadow.show();
            shadowShow.show();
            setTimeout(function(){
            shadow.hide('slow');
            shadowShow.hide('slow');  
            },2000);
            form[0].reset();
        }else{ 
            output.hide();
            shadow.show();
            shadowError.show();
            setTimeout(function(){
            shadowError.hide('slow');
            $('#output').show();  
            },1000);
        }
    },   

});

//close shadow-show
    $('.r-close').click(function(){
        shadow.hide('slow');
        $('.shadow-show').hide('slow');
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
<div class="b-bottom"></div>
</body>
</html>