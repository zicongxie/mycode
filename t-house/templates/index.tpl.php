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
        <div class="spe-title">������ɫ</div>
        <ul>
            <div class="g-li">
                <li class="l-left">1</li><li class="l-right"><span class="g-span-color">�ͱ��˻�һ����Ǯ��װ�����巿��Ч��</span>���깤ʵ�����ܲμӱ������л����ô�Ŷ��</li>
            </div>
            <div class="g-li">
                <li class="l-left">2</li><li class="l-right">����һ�����ͬʱ�п��ܻ�����ݴ󽱡���װ���ռǴ��������巿��ƴ����� <span class="g-span-color">��Ʒ�ܼ�ֵ����</span>��</li>
            </div>
            <div class="g-li">
                <li class="l-left">3</li><li class="l-right">ҵ����װ�ι�˾���Ŷӹ�ϵ�����ǵĹ�ͬĿ���ǣ�ҵ����������<span class="g-span-color">�������巿��ƴ󽱣�ʩ���������������ܻ�ӭװ�ι�˾��;</span></li>
            </div>
            <div class="g-li">
                <li class="l-left">4</li><li class="l-right">4.ÿ��װ�ι�˾��Ϊ����ҵ�����º�������������<span class="g-span-color">���ɻ��ʩ��װ�ι�˾���ر���</span>��������巿����֮����ɫ���񡿣�</li>
            </div>
            <div class="g-li">
                <li class="l-left">5</li><li class="l-right">5.ÿ��װ�޹��ض�����ɡ�ҵ��-װ�ι�˾-���ӼҾӡ�����΢�Ż���С�飬<span class="g-span-color">ʵʱ�������ؽ�չ���ල����ʵ������װ����ʡ�ģ�</span></li>
            </div>
        </ul>   
    </div>
    <div class="game-sub">
        <div class="gam-title">30����ٱ��� <span>����1915λ���ѱ���</span></div>
        <form action="?a=ajax_sign&i=1" class="sub-form" name="myform"  method="post">
            <div class="form-control">
                <label>��������</label>
                <input type="text" class="inp-text" name="info[name]" placeholder="����д��������" datatype="*" nullmsg="���ֲ���Ϊ��" />
            </div>
            <div class="form-control">
                <label>�����ֻ�</label>
                <input type="text" class="inp-text" name="info[phone]" placeholder="����д�����ֻ�" datatype="m" nullmsg="����д11λ�ֻ�����"/>
            </div>
            <div class="form-control">
                <label>С������</label>
                <input type="text" class="inp-text" name="info[areaname]" placeholder="����д����С����" datatype="*" nullmsg="С��������Ϊ��"/>
            </div>
            <div class="form-control">
                <label><pre style="display:inline;font-family:microsoft YaHei;">��       ��</pre></label>
                <input type="text" class="inp-text inp-text-m " name="info[usearea]"placeholder="����д���ķ������" datatype="n" nullmsg="����д�������"  />
                <span class="sub-span">�O</span>
            </div>
            <div class="btn-submit" >
                <input type="submit" class="inp-submit" name="sub"  value="��������"/>
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
            <dd class="hl-dd1"><?php echo $infos1[$key]['bulidname'];?><?php $n = strpos($infos1[$key]['tag'], ' ');$str=substr($infos1[$key]['tag'], 0, $n);if($str){echo "��".$str;}elseif($infos1[$key]['tag']){echo "��".$infos1[$key]['tag'];}?><?php if($infos1[$key]['usearea']) echo "��".$infos1[$key]['usearea']."�O"?><?php if($infos1[$key]['freeprice']) echo "��".$infos1[$key]['freeprice'];?><?php if($infos1[$key]['designprice']) echo "��".$infos1[$key]['designprice'];?><div class="hl-dd-f-right"><img src="<?PHP echo ZT_IMAGES?>eye.png" /> <?php $no = $infos1[$key]['no']; echo $readnum[$no] + $infos1[$key]['readnum'];?></div>
            </dd>
            <input type="hidden" class="y_id" value="<?php echo $infos1[$key]['id']; ?>">
            <input type="hideen" class="order_num" value="<?php echo $infos1[$key]['order'];?>" style="display:none">
            <dt class="h-dt-bottom"><div class="h-t-div1"><?php 
                                                            switch ($infos1[$key]['constrpart']) {
                                                                case '1':
                                                                    echo "�Ͼ�װ��";
                                                                    break;
                                                                case '2':
                                                                    echo "�װ�װ��";
                                                                    break;
                                                                case '3':
                                                                    echo "����װ��";
                                                                    break;
                                                                case '4':
                                                                    echo "����װ��";
                                                                    break;
                                                                case '5':
                                                                    echo "�ʳ�װ��";
                                                                    break;
                                                            }
                                                          ?>���</div><div class="h-t-div2" >ԤԼ�ι�</div></dt>
        </dl>
    <?php endforeach;?>
    <?php foreach ($infos2 as $key => $val):?>
        <dl>
            <dt><a href="?a=detail&id=<?php echo $infos2[$key]['id'];?>"><img src="<?php echo $infos2[$key]['thumb'];?>"></a></dt>
            <dd class="hl-dd1"><?php echo $infos2[$key]['bulidname'];?><?php $n = strpos($infos2[$key]['tag'], ' ');$str=substr($infos2[$key]['tag'], 0, $n);if($str){echo "��".$str;}elseif($infos2[$key]['tag']){echo "��".$infos2[$key]['tag'];}?><?php if($infos2[$key]['usearea']) echo "��".$infos2[$key]['usearea']."�O"?><?php if($infos2[$key]['freeprice']) echo "��".$infos2[$key]['freeprice'];?><?php if($infos2[$key]['designprice']) echo "��".$infos2[$key]['designprice'];?><div class="hl-dd-f-right"><img src="<?PHP echo ZT_IMAGES?>eye.png" /> <?php $no = $infos2[$key]['no']; echo $readnum[$no] + $infos2[$key]['readnum'];?></div>
            </dd>
            <input type="hidden" class="y_id" value="<?php echo $infos2[$key]['id']; ?>">
            <input type="hideen" class="order_num" value="<?php echo $infos2[$key]['order'];?>" style="display:none">
            <dt class="h-dt-bottom"><div class="h-t-div1"><?php 
                                                            switch ($infos2[$key]['constrpart']) {
                                                                case '1':
                                                                    echo "�Ͼ�װ��";
                                                                    break;
                                                                case '2':
                                                                    echo "�װ�װ��";
                                                                    break;
                                                                case '3':
                                                                    echo "����װ��";
                                                                    break;
                                                                case '4':
                                                                    echo "����װ��";
                                                                    break;
                                                                case '5':
                                                                    echo "�ʳ�װ��";
                                                                    break;
                                                            }
                                                          ?>���</div><div class="h-t-div2" >ԤԼ�ι�</div></dt>
        </dl>
    <?php endforeach;?>
    <?php foreach ($infos3 as $key => $val):?>
        <dl>
            <dt><a href="?a=detail&id=<?php echo $infos3[$key]['id'];?>"><img src="<?php echo $infos3[$key]['thumb'];?>"></a></dt>
            <dd class="hl-dd1"><?php echo $infos3[$key]['bulidname'];?><?php $n = strpos($infos3[$key]['tag'], ' ');$str=substr($infos3[$key]['tag'], 0, $n);if($str){echo "��".$str;}elseif($infos3[$key]['tag']){echo "��".$infos3[$key]['tag'];}?><?php if($infos3[$key]['usearea']) echo "��".$infos3[$key]['usearea']."�O"?><?php if($infos3[$key]['freeprice']) echo "��".$infos3[$key]['freeprice'];?><?php if($infos3[$key]['designprice']) echo "��".$infos3[$key]['designprice'];?><div class="hl-dd-f-right"><img src="<?PHP echo ZT_IMAGES?>eye.png" /> <?php $no = $infos3[$key]['no']; echo $readnum[$no] + $infos3[$key]['readnum'];?></div>
            </dd>
            <input type="hidden" class="y_id" value="<?php echo $infos3[$key]['id']; ?>">
            <input type="hideen" class="order_num" value="<?php echo $infos3[$key]['order'];?>" style="display:none">
            <dt class="h-dt-bottom"><div class="h-t-div1"><?php 
                                                            switch ($infos3[$key]['constrpart']) {
                                                                case '1':
                                                                    echo "�Ͼ�װ��";
                                                                    break;
                                                                case '2':
                                                                    echo "�װ�װ��";
                                                                    break;
                                                                case '3':
                                                                    echo "����װ��";
                                                                    break;
                                                                case '4':
                                                                    echo "����װ��";
                                                                    break;
                                                                case '5':
                                                                    echo "�ʳ�װ��";
                                                                    break;
                                                            }
                                                          ?>���</div><div class="h-t-div2" >ԤԼ�ι�</div></dt>
        </dl>
    <?php endforeach;?>
    <?php foreach ($infos4 as $key => $val):?>
        <dl>
            <dt><a href="?a=detail&id=<?php echo $infos4[$key]['id'];?>"><img src="<?php echo $infos4[$key]['thumb'];?>"></a></dt>
            <dd class="hl-dd1"><?php echo $infos4[$key]['bulidname'];?><?php $n = strpos($infos4[$key]['tag'], ' ');$str=substr($infos4[$key]['tag'], 0, $n);if($str){echo "��".$str;}elseif($infos4[$key]['tag']){echo "��".$infos4[$key]['tag'];}?><?php if($infos4[$key]['usearea']) echo "��".$infos4[$key]['usearea']."�O"?><?php if($infos4[$key]['freeprice']) echo "��".$infos4[$key]['freeprice'];?><?php if($infos4[$key]['designprice']) echo "��".$infos4[$key]['designprice'];?><div class="hl-dd-f-right"><img src="<?PHP echo ZT_IMAGES?>eye.png" /> <?php $no = $infos4[$key]['no']; echo $readnum[$no] + $infos4[$key]['readnum'];?></div>
            </dd>
            <input type="hidden" class="y_id" value="<?php echo $infos4[$key]['id']; ?>">
            <input type="hideen" class="order_num" value="<?php echo $infos4[$key]['order'];?>" style="display:none">
            <dt class="h-dt-bottom"><div class="h-t-div1"><?php 
                                                            switch ($infos4[$key]['constrpart']) {
                                                                case '1':
                                                                    echo "�Ͼ�װ��";
                                                                    break;
                                                                case '2':
                                                                    echo "�װ�װ��";
                                                                    break;
                                                                case '3':
                                                                    echo "����װ��";
                                                                    break;
                                                                case '4':
                                                                    echo "����װ��";
                                                                    break;
                                                                case '5':
                                                                    echo "�ʳ�װ��";
                                                                    break;
                                                            }
                                                          ?>���</div><div class="h-t-div2" >ԤԼ�ι�</div></dt>
        </dl>
    <?php endforeach;?>
    <?php foreach ($infos5 as $key => $val):?>
        <dl>
            <dt><a href="?a=detail&id=<?php echo $infos5[$key]['id'];?>"><img src="<?php echo $infos5[$key]['thumb'];?>"></a></dt>
            <dd class="hl-dd1"><?php echo $infos5[$key]['bulidname'];?><?php $n = strpos($infos5[$key]['tag'], ' ');$str=substr($infos5[$key]['tag'], 0, $n);if($str){echo "��".$str;}elseif($infos5[$key]['tag']){echo "��".$infos5[$key]['tag'];}?><?php if($infos5[$key]['usearea']) echo "��".$infos5[$key]['usearea']."�O"?><?php if($infos5[$key]['freeprice']) echo "��".$infos5[$key]['freeprice'];?><?php if($infos5[$key]['designprice']) echo "��".$infos5[$key]['designprice'];?><div class="hl-dd-f-right"><img src="<?PHP echo ZT_IMAGES?>eye.png" /> <?php $no = $infos5[$key]['no']; echo $readnum[$no] + $infos5[$key]['readnum'];?></div>
            </dd>
            <input type="hidden" class="y_id" value="<?php echo $infos5[$key]['id']; ?>">
            <input type="hideen" class="order_num" value="<?php echo $infos5[$key]['order'];?>" style="display:none">
            <dt class="h-dt-bottom"><div class="h-t-div1"><?php 
                                                            switch ($infos5[$key]['constrpart']) {
                                                                case '1':
                                                                    echo "�Ͼ�װ��";
                                                                    break;
                                                                case '2':
                                                                    echo "�װ�װ��";
                                                                    break;
                                                                case '3':
                                                                    echo "����װ��";
                                                                    break;
                                                                case '4':
                                                                    echo "����װ��";
                                                                    break;
                                                                case '5':
                                                                    echo "�ʳ�װ��";
                                                                    break;
                                                            }
                                                          ?>���</div><div class="h-t-div2" >ԤԼ�ι�</div></dt>
        </dl>
    <?php endforeach;?>
    </ul>
</div>

<div class="goods" id="goods">
    <div class="go-title">������Ʒ</div>
    <ul>
        <li>
            <img src="<?PHP echo ZT_IMAGES?>g_01.png">
            <dt class="good-m-color">������巿װ�޹ھ���1����</dt>
            <dd><p>��ֵԼ<span class="good-m-color">5500Ԫ</span></p><p>ӣ�������̻�+ȼ���������� ��һ�ף�</p></dd>
        </li>
        <li>
            <img src="<?PHP echo ZT_IMAGES?>g_02.png">
            <dt>������巿װ���Ǿ���1����</dt>
            <dd><p>��ֵԼ<span class="good-m-color">5000Ԫ</span></p><p>50Ӣ��4K������LEDҺ�����ӣ�һ̨��</p></dd>
        </li>
        <li class="good-l-li">
            <img src="<?PHP echo ZT_IMAGES?>g_03.png">
            <dt class="good-m-color2">������巿װ�޼�����1����</dt>
            <dd><p>��ֵԼ<span class="good-m-color">2500Ԫ</span></p><p>���²���ϴ�»���һ̨��</p></dd>
        </li>
    </ul> 
    <h4>��ѡԭ��:</h4>
    <p>һ��ʩ��ʱ������ҵ��������̳д��װ���ռǡ���¼ʩ��ʵ�����깤���������������������깤ʵ����</p>
    <p> &nbsp;��С����԰�æ����������ʵ����Ŷ��</p>  
    <p>������װ���ռǡ�+���������깤ʵ�����������ӵĵ����ظ�����ռ���ȵ�40%</p>  
    <p>�������������깤ʵ�����������繫��ͶƱ��ռ���ȵ�20%</p>
    <p>�ġ�רҵ��ίС���֣�ռ���ȵ�40%����ί�����Ժ󹫲���</p>
    <h2>����ͶƱ����������巿��10����</h2>
    <p>��ֵԼ<span class="good-m-color">339Ԫ</span> ������΢��¯����һ̨��</p>
    <h4 style="display:inline;">��ѡԭ��:</h4><p  style="display:inline;">���������깤ʵ�����������繫��ͶƱ����Ч���ͶƱǰʮ��</p>
    <h2>2015�����������ܻ�ӭװ�ι�˾��1����</h2>
    <p>�����ӼҾӰ䷢��������</p>
    <h4>��ѡԭ��</h4>
    <p>һ�����λ�У�δ�ܵ�����Ͷ��</p>
    <p>�����񽱰�������װ�ι�˾��δ��Ͷ����1������0������1���ܶ��0��������Ŷ����</p>
</div>

<div class="business">
    <div class="bu-title">�����̼�</div>
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
        <div class="form-title">�����巿����<span id="c-num"></span>λ����ԤԼ�ι� <a href="javascript:;" id="b-close" class="close" ><img src="<?PHP echo ZT_IMAGES?>close.png" /></a></div>
            <div class="form-control">
                <label>*��������</label>
                <input type="text" class="inp-text" name="info[name]" placeholder="����д��������" datatype="*" nullmsg="���ֲ���Ϊ��" />
            </div>
            <div class="form-control">
                <label>*�����ֻ�</label>
                <input type="text" class="inp-text" name="info[phone]" placeholder="����д�����ֻ�" datatype="m" nullmsg="����д11λ�ֻ�����"/>
            </div>
            <div class="form-control">
                <label>&nbsp;���ԤԼ </label>
                <input type="text" class="inp-text" name="info[date]" placeholder="����д��ҪԤԼ������" datatype="*" nullmsg="ԤԼ�����ڲ���Ϊ��" class="laydate-icon" onfocus="laydate()"/>
            </div>
            <input type="text" name="id" id="y_val" value="" style="display:none;">
            <div class="btn-submit" >
                <input type="submit" class="inp-submit" name="sub"  value="���ԤԼ"/>
            </div>
    </form>
</div>

<div class="shadow-show" id="shadow-show">
    <div><a href="javascript:;" id="close" class="r-close" ><img src="<?PHP echo ZT_IMAGES?>close.png" /></a></div>
    <div class="show-center"><img src="<?PHP echo ZT_IMAGES?>true.png"></div>
    <p class="show-larfont">��ϲ������Ϣ�ύ�ɹ�</p>
    <p>��л��ı������Ҿӿͷ��ᾡ������ȡ����ϵ��</p>
</div>
<div class="shadow-show" id="shadow-error">
    <div><a href="javascript:;" id="close" class="r-close" ><img src="<?PHP echo ZT_IMAGES?>close.png" /></a></div>
    <div class="show-center"><img src="<?PHP echo ZT_IMAGES?>false.png"></div>
    <p class="show-larfont">����ʧ�ܣ������²���</p>
</div>
<div class="shadow-show" id="shadow-b-true">
    <div><a href="javascript:;" id="close" class="r-close" ><img src="<?PHP echo ZT_IMAGES?>close.png" /></a></div>
    <div class="show-center"><img src="<?PHP echo ZT_IMAGES?>true.png"></div>
    <p class="show-larfont">��ϲ������Ϣ�ύ�ɹ�</p>
    <p>��л���ԤԼ���Ҿӿͷ��ᾡ������ȡ����ϵ��</p>
</div>
<script type="text/javascript">
$(function(){
//���ֲ�
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