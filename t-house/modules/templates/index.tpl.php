<?php 
defined('IN_ADMIN') or exit('No permission resources.');
$show_validator = true;
$show_header = false;
include $this->admin_tpl('header','admin');
?>

<!-- 导航条 -->
<div class="subnav">
    <div class="content-menu ib-a blue line-x">
        <a href="index.php?m=<?php echo ROUTE_M;?>&c=<?php echo ROUTE_C;?>&a=init&path=<?php echo $_GET['path']?>" <?php if(ROUTE_A == 'init'){?>class="on"<?php }?>>
            <em>报名列表</em>
        </a>
    <span>|</span>
        <a href="index.php?m=<?php echo ROUTE_M;?>&c=<?php echo ROUTE_C;?>&a=apply_add&path=<?php echo $_GET['path']?>" <?php if(ROUTE_A == 'apply_add'){?>class="on"<?php }?>>
            <em>添加/编辑报名人数</em>
        </a>
    <span>|</span>
        <a href="index.php?m=<?php echo ROUTE_M;?>&c=<?php echo ROUTE_C;?>&a=players&path=<?php echo $_GET['path']?>" <?php if(ROUTE_A == 'players'){?>class="on"<?php }?>>
            <em>样品房信息表</em>
        </a>
    <span>|</span>
        <a href="index.php?m=<?php echo ROUTE_M;?>&c=<?php echo ROUTE_C;?>&a=players_add&path=<?php echo $_GET['path']?>" <?php if(ROUTE_A == 'players_add'){?>class="on"<?php }?>>
            <em>添加/编辑样品房信息</em>
        </a>
    <span>|</span>
        <a href="index.php?m=<?php echo ROUTE_M;?>&c=<?php echo ROUTE_C;?>&a=part_info&path=<?php echo $_GET['path']?>" <?php if(ROUTE_A == 'part_info'){?>class="on"<?php }?>>
            <em>商家信息</em>
        </a>
    <!-- <span>|</span>
        <a href="index.php?m=<?php echo ROUTE_M;?>&c=<?php echo ROUTE_C;?>&a=part_modify&path=<?php echo $_GET['path']?>" <?php if(ROUTE_A == 'part_modify'){?>class="on"<?php }?>>
            <em>编辑商家信息</em>
        </a> -->
    </div>
</div>

<!-- 报名列表 -->
<?php if (ROUTE_A == 'init') {?>
<div class="pad-lr-10">
<div id="searchid">
<form name="searchform" id="searchform" action="" method="get" >
<input type="hidden" name="m" value="<?php echo ROUTE_M;?>">
<input type="hidden" name="c" value="<?php echo ROUTE_C;?>">
<input type="hidden" name="a" value="<?php echo ROUTE_A;?>">
<input type="hidden" name="path" value="<?php echo $_GET['path'];?>">

<!-- 搜索栏 -->
<table width="100%" cellspacing="0" class="search-form">
    <tbody>
		<tr>
			<td>
				<div class="explain-col">
				<!-- 姓名关键字：<input type="text" name="keyword" value="<?php echo $keyword;?>">&nbsp; -->
				关键字：<input type="text" name="keyword1" value="<?php echo $keyword1;?>">&nbsp;
				添加时间：<?php echo form::date('starttime', $_GET['starttime'] , 0 , 0, 'false');?>- &nbsp;<?php echo form::date('endtime', $_GET['endtime'], 0, 0, 'false');?>
				<input type="hidden" name="status" value="1">
				<input type="submit" name="dosearch" class="button" value=" 搜索 " />
				</div>
			</td>
		</tr>
    </tbody>
</table>
</form>
</div>
<div style="height:20px;line-height:20px;padding-left:10px;margin-bottom:10px;">
	符合<?php if($condition){echo '<span style="color:red;font-weight:bold;">“'.$condition.'”</span>';}?>条件的记录共<span style="color:red;font-weight:bold;"><?php echo $counts?></span>个
	&nbsp;
	<?php if($condition){?>[<a href="index.php?m=<?php echo ROUTE_M;?>&c=<?php echo ROUTE_C;?>&a=<?php echo ROUTE_A;?>&path=<?php echo $_GET['path'];?>">清空搜索条件</a>]
    <?php }?>
</div>

<!-- main -->
<div class="table-list pad-lr-10">
    <form action="index.php?m=<?php echo ROUTE_M?>&c=<?php echo ROUTE_C?>&a=apply_delete&path=<?php echo $_GET['path'];?>&pc_hash=<?php echo $_GET['pc_hash'];?>" id="myform" method="post">
        <table width="100%" cellspacing="0">
                <thead>
        			<tr>
        				<th width="50" align="center"><input type="checkbox" onclick="selectall('id[]');" id="check_box" value=""></th>
                        <th width="50" align="center">名字</th>
        				<th width="100" align="center">电话</th>
        				<th width="100" align="center" >小区名字</th>
        				<th width="30" align="center">使用面积</th>
        				<th width="200" align="center" >来源</th>
        				<th width="50" align="center">报名日期</th>
        				<th width="200" align="center" >操作</th>
        			</tr>
                </thead>
                <?php foreach ($infos as $info){?>
                <tr>
                		<td align="center" ><input type="checkbox" value="<?php echo $info['id']?>" name="id[]" class="inputcheckbox "></td>
                        <td align="center" ><?php echo $info['name'];?></td>
                		<td align="center" ><?php echo $info['phone'];?></td>
        				<td align="center"><?php echo $info['areaname']?></td>
        				<td align="center" ><?php echo $info['usearea']?></td>
        				<td align="center" ><?php echo $info['source']?></td>
        				<td align="center" ><?php echo date("Y-m-d",$info['dateline']);?></td>
        				<td align="center" >
                        <!-- <a href="javascript:window.top.art.dialog({id:'add',content:'<?php if($info['thumb']){ ?><img width=\'1024\' height=\'768\' src=\'<?php echo $info['thumb'];?>\' /><?php }else{echo '没有图片';}?>', title:'作品图片', width:'1024', height:'768', lock:false}, function(){var d = window.top.art.dialog({id:'add'}).data.iframe;var form = d.document.getElementById('dosubmit');form.click();return false;}, function(){window.top.art.dialog({id:'add'}).close()});void(0);">查看作品图片</a>&nbsp;&nbsp;|&nbsp;&nbsp; -->
                        <a href="?m=<?php echo ROUTE_M;?>&c=<?php echo ROUTE_C?>&a=apply_add&id=<?php echo $info['id']?>&path=<?php echo $_GET['path']?>&pc_hash=<?php echo $_GET['pc_hash']?>">编辑</a>&nbsp;&nbsp;|&nbsp;&nbsp;
        				<a onclick="return confirm('确认删除吗？');" href="index.php?m=<?php echo ROUTE_M;?>&c=<?php echo ROUTE_C;?>&a=apply_delete&path=<?php echo $_GET['path']?>&id=<?php echo $info['id']?>&pc_hash=<?php echo $_GET['pc_hash']?>">删除</a><br>
        				</td>
        			</tr>
                <?php }?>
        </table>
        <div class="btn">
            <label for="check_box">全选/取消</label> &nbsp; 
            <input  type="submit" onclick="return confirm('确定要删除？');" class="button" name="dodelete" id="dodelete" value=" 删除 ">&nbsp;&nbsp;
        </div>
    </form>
    <div id="pages"><?php echo $pages?></div>
</div>

<!-- 样品房信息表 -->
<?php }elseif(ROUTE_A == 'players'){?>
<!-- 搜索栏 -->
<form name="searchform" id="searchform" action="" method="get" >
<input type="hidden" name="m" value="<?php echo ROUTE_M;?>">
<input type="hidden" name="c" value="<?php echo ROUTE_C;?>">
<input type="hidden" name="a" value="<?php echo ROUTE_A;?>">
<input type="hidden" name="path" value="<?php echo $_GET['path'];?>">
<table width="100%" cellspacing="0" class="search-form">
    <tbody>
        <tr>
            <td>
                <div class="explain-col">
                关键字：<input type="text" name="keyword1" value="<?php echo $keyword1;?>">&nbsp;
                装饰公司：  <select name="keyword2">
                                <option value=""></option>
                                <option value="1">蜗居装饰</option>
                                <option value="2">易百装饰</option>
                                <option value="3">华宁装饰</option>
                                <option value="4">三星装饰</option>
                                <option value="5">皇城装饰</option>
                            </select>&nbsp;
                添加时间：<?php echo form::date('starttime', $_GET['starttime'] , 0 , 0, 'false');?>- &nbsp;<?php echo form::date('endtime', $_GET['endtime'], 0, 0, 'false');?>
                <input type="hidden" name="status" value="1">
                <input type="submit" name="dosearch" class="button" value=" 搜索 " />
                </div>
            </td>
        </tr>
    </tbody>
</table>
</form>
</div>
<div style="height:20px;line-height:20px;padding-left:10px;margin-bottom:10px;">
    符合<?php if($condition){echo '<span style="color:red;font-weight:bold;">“'.$condition.'”</span>';}?>条件的记录共<span style="color:red;font-weight:bold;"><?php echo $counts?></span>个
    &nbsp;
    <?php if($condition){?>[<a href="index.php?m=<?php echo ROUTE_M;?>&c=<?php echo ROUTE_C;?>&a=<?php echo ROUTE_A;?>&path=<?php echo $_GET['path'];?>">清空搜索条件</a>]
    <?php }?>
</div>

    <div class="table-list pad-lr-10">
        <form action="index.php?m=<?php echo ROUTE_M?>&c=<?php echo ROUTE_C?>&a=players_delete&path=<?php echo $_GET['path'];?>&pc_hash=<?php echo $_GET['pc_hash'];?>" id="myform" method="post">
            <table width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th width="50" align="center"><input type="checkbox" onclick="selectall('id[]');" id="check_box" value=""></th>
                    <th width="50" align="center">样品房大标题</th>
                    <!-- <th width="50" align="center">编号</th> -->
                    <th width="100" align="center" >楼盘名称</th>
                    <!-- <th width="50" align="center" >建筑面积</th>
                    <th width="50" align="center" >实用面积</th>
                    <th width="50" align="center" >户型结构</th> -->
                    <th width="50" align="center" >施工单位</th>
                    <!-- <th width="50" align="center" >主要材料</th>
                    <th width="50" align="center" >项目造价</th>
                    <th width="50" align="center" >联系方式</th>
                    <th width="50" align="center" >联系地址</th> -->
<!--                     <th width="100" align="center" >样品房介绍</th> -->
                    <!-- <th width="50" align="center" >票数</th> -->
                    <th width="50" align="center" >报名人数</th>
                    <th width="50" align="center" >点击数</th>
                    <!-- <th width="50" align="center" >半包价格</th>
                    <th width="50" align="center" >设计费</th>
                    <th width="50" align="center" >促销</th> -->
                    <!-- <th width="50" align="center" >是否显示</th> -->
                    <th width="50" align="center" >日期</th>
                    <th width="200" align="center" >操作</th>
                </tr>
                </thead>
                <?php foreach ($infos as $info){?>
                    <tr>
                        <td align="center" ><input type="checkbox" value="<?php echo $info['id']?>" name="id[]" class="inputcheckbox "></td>
                        <td align="center" ><?php echo $info['title'];?></td>
                        <!-- <td align="center" ><?php echo $info['no'];?></td> -->
                        <td align="center" ><?php echo $info['bulidname'];?></td>
                        <!-- <td align="center" ><?php echo $info['bulidarea'];?></td>
                        <td align="center" ><?php echo $info['usearea'];?></td>
                        <td align="center" ><?php echo $info['housestyle'];?></td> -->
                        <td align="center" >
                            <?php 
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
                        </td>
                        <!-- <td align="center" ><?php echo $info['material'];?></td>
                        <td align="center" ><?php echo $info['price'];?></td>
                        <td align="center" ><?php echo $info['phone'];?></td>
                        <td align="center" ><?php echo $info['address'];?></td> -->
                   <!-- <td align="center" ><?php //echo $info['content'];?></td> -->
                        <!-- td align="center" ><?php echo $info['votesnum'];?></td> -->
                        <td align="center" ><?php echo $info['applynum'];?></td>
                        <td align="center" ><?php echo $info['readnum'];?></td>
                        <!-- <td align="center" ><?php echo $info['freeprice'];?></td>
                        <td align="center" ><?php echo $info['designprice'];?></td>
                        <td align="center" ><?php echo $info['sales']?></td> -->
                        <!-- <td width="100" align="center"><input type="checkbox" onchange="location.href='index.php?m=<?php echo ROUTE_M;?>&c=<?php echo ROUTE_C;?>&a=news_confirm&id=<?php echo $info['id']; ?>&path=<?php echo $_GET['path'];?>&pc_hash=<?php echo $_GET['pc_hash'];?>&return_url=<?php echo urlencode(get_url()); ?>';" name="confirm[<?php echo $info['id']?>]" <?php if ($info['confirm'] == 1){ echo "checked='checked'";}?>/></td> -->
                        <td align="center" ><?php echo date("Y-m-d",$info['dateline']);?></td>
                        <td align="center" >
                            
                            <a href="?m=<?php echo ROUTE_M;?>&c=<?php echo ROUTE_C?>&a=pic_add&id=<?php echo $info['id']?>&path=<?php echo $_GET['path']?>&pc_hash=<?php echo $_GET['pc_hash']?>">编辑图片</a>&nbsp;&nbsp;|&nbsp;&nbsp;

                            <a href="?m=<?php echo ROUTE_M;?>&c=<?php echo ROUTE_C?>&a=players_add&id=<?php echo $info['id']?>&path=<?php echo $_GET['path']?>&pc_hash=<?php echo $_GET['pc_hash']?>">编辑</a>&nbsp;&nbsp;|&nbsp;&nbsp;

                            <a onclick="return confirm('确认删除吗？');" href="index.php?m=<?php echo ROUTE_M;?>&c=<?php echo ROUTE_C;?>&a=players_delete&path=<?php echo $_GET['path']?>&id=<?php echo $info['id']?>&pc_hash=<?php echo $_GET['pc_hash']?>">删除</a>
                            <br>
                        </td>
                    </tr>
                <?php }?>
            </table>
            <div class="btn">
                <label for="check_box">全选/取消</label> &nbsp;
                <input  type="submit" onclick="return confirm('确定要删除？');" class="button" name="dodelete" id="dodelete" value=" 删除 ">&nbsp;&nbsp;
            </div>
        </form>
        <div id="pages"><?php echo $pages?></div>
    </div>

<!-- 标记、添加报名列表 -->
<?php }elseif (ROUTE_A == 'apply_add'){?>
    <script type="text/javascript">
        $(function(){
            $.formValidator.initConfig({autotip:true,formid:"myform",onerror:function(msg){}});
            var check_array = new Array('name','phone','areaname','usearea');
            for(var i = 0; i < check_array.length;i++){
                $('#'+check_array[i]).formValidator({onshow:'必填项',onfocus:'不能为空'}).inputValidator({min:1,onerror:'不能为空'});
            }
        });
    </script>
    <div class="pad_10">
        <div class="common-form">
            <form name="myform" action="index.php?m=<?php echo ROUTE_M;?>&c=<?php echo ROUTE_C;?>&a=apply_add&id=<?php echo $id;?>&path=<?php echo $this->path;?>&pc_hash=<?php echo $_GET['pc_hash'];?>" method="post" id="myform">
                <table width="100%" class="table_form contentWrap">
                    <tr>
                        <th width="100">名称：</th>
                        <td><input type="text" name="info[name]" size="30" class="input-text" id="name" value="<?php echo $info['name'];?>"></td>
                    </tr>
                    <tr>
                        <th width="100">电话：</th>
                        <td><input type="text" name="info[phone]" size="30" class="input-text" id="phone" value="<?php echo $info['phone'];?>"></td>
                    </tr>
                    <tr>
                        <th width="100">小区名字：</th>
                        <td><input type="text" name="info[areaname]" size="30" class="input-text" id="areaname" value="<?php echo $info['areaname'];?>"></td>
                    </tr>
                    <tr>
                        <th width="100">实用面积：</th>
                        <td><input type="text" name="info[usearea]" size="30" class="input-text" id="usearea" value="<?php echo $info['usearea'];?>"></td>
                    </tr>
                    <tr>
                        <th width="100">是否显示：</th>
                        <td><input type="checkbox" name="info[confirm]" value="1" <?php if(!$id || $info['confirm'] == 1){?>checked="checked" <?php }?>></td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            <input name="dosubmit" type="submit" value=" 提交 " class="button" id="dosubmit">
                            <input type="reset" value="重置" class="button">
                            <input type="button" onclick="history.go(-1)" value="后退" class="button">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

<!-- 编辑、添加样品房信息 -->
<?php }elseif (ROUTE_A == 'players_add'){?>
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH;?>house_admin.css">
    <script type="text/javascript">
        $(function(){
            $.formValidator.initConfig({autotip:true,formid:"myform",onerror:function(msg){}});
            var check_array = new Array('title','bulidname');
            for(var i = 0; i < check_array.length;i++){
                $('#'+check_array[i]).formValidator({onshow:'必填项',onfocus:'不能为空'}).inputValidator({min:1,onerror:'不能为空'});
            }
            
            if (parseInt(<?php echo $info['constrpart'];?>) == 2) {
                $('#yibai').attr("selected", true);
            }
            if (parseInt(<?php echo $info['constrpart'];?>) == 1) {
                $('#woju').attr("selected", true);
            }
            if (parseInt(<?php echo $info['constrpart'];?>) == 3) {
                $('#huaning').attr("selected", true);
            }
            if (parseInt(<?php echo $info['constrpart'];?>) == 4) {
                $('#sanxing').attr("selected", true);
            }
            if (parseInt(<?php echo $info['constrpart'];?>) == 5) {
                $('#huangcheng').attr("selected", true);
            }
        });

        function DoChange(value){
            switch(parseInt(value)){
            case 1:
                $('input[id="phone"]').attr('value','0752-2762520');
                $('input[id="address"]').attr('value','河南岸演达大道曼哈顿广场1208室');
                break;
            case 2:
                $('input[id="phone"]').attr('value','0752-5787517');
                $('input[id="address"]').attr('value','惠城区江北曼哈顿广场2416-2420室');
                break;
            case 3:
                $('input[id="phone"]').attr('value','0750-2666662');
                $('input[id="address"]').attr('value','河南岸演达一路鸿润大厦首层1-2号商铺');
                break;
            case 4:
                $('input[id="phone"]').attr('value','13751570338');
                $('input[id="address"]').attr('value','桃子园53号达利商务中心505室');
                break;
            case 5:
                $('input[id="phone"]').attr('value','0752-2211709');
                $('input[id="address"]').attr('value','河南岸演达大道19号汽车博览中心5层01号');
                break;
           }
        }

    </script>

    <div class="pad_10">
        <div class="common-form">
            <form name="myform" action="index.php?m=<?php echo ROUTE_M;?>&c=<?php echo ROUTE_C;?>&a=players_add&id=<?php echo $id;?>&path=<?php echo $this->path;?>&pc_hash=<?php echo $_GET['pc_hash'];?>" method="post" id="myform">
                <table width="100%" class="table_form contentWrap">
                    <tr>
                        <th width="100">样品房大标题：</th>
                        <td><input type="text" name="info[title]" size="50" class="input-text" id="title" value="<?php echo $info['title'];?>"></td>
                    </tr>
                    <tr>
                        <th width="100">样品房编号：</th>
                        <td><input type="text" name="info[no]" size="50" class="input-text" id="no" value="<?php echo $info['no'];?>"></td>
                    </tr>
                    <tr>
                        <th width="100">楼盘名称：</th>
                        <td><input type="text" name="info[bulidname]" size="50" class="input-text" id="bulidname" value="<?php echo $info['bulidname'];?>"></td>
                    </tr>
                    <tr>
                        <th width="100">建筑面积：</th>
                        <td><input type="text" name="info[bulidarea]" size="50" class="input-text" id="bulidarea" value="<?php echo $info['bulidarea'];?>"></td>
                    </tr>
                    <tr>
                        <th width="100">实用面积：</th>
                        <td><input type="text" name="info[usearea]" size="50" class="input-text" id="usearea" value="<?php echo $info['usearea'];?>"></td>
                    </tr>
                    <tr>
                        <th width="100">户型结构：</th>
                        <td><input type="text" name="info[housestyle]" size="50" class="input-text" id="housestyle" value="<?php echo $info['housestyle'];?>"></td>  
                    </tr>
                    <tr>
                        <th width="100">施工单位：</th>
                        <!-- <td><input type="text" name="info[constrpart]" size="50" class="input-text" id="constrpart" value="<?php echo $info['constrpart'];?>"></td> -->
                        <td>
                            <select name="info[constrpart]" id="constrpart" class="constrpart" onchange="DoChange(this.value);">
                                <option value="">请选择</option>
                                <option value="1"  id="woju">蜗居装饰</option>
                                <option value="2" id="yibai">易百装饰</option>
                                <option value="3" id="huaning">华宁装饰</option>
                                <option value="4" id="sanxing">三星装饰</option>
                                <option value="5" id="huangcheng">皇城装饰</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th width="100">主要材料：</th>
                        <td><input type="text" name="info[material]" size="50" class="input-text" id="material" value="<?php echo $info['material'];?>"></td>
                    </tr>
                    <tr>
                        <th width="100">项目造价：</th>
                        <td><input type="text" name="info[price]" size="50" class="input-text" id="price" value="<?php echo $info['price'];?>"></td>
                    </tr>
                    <tr>
                        <th width="100">标签：</th>
                        <td><input type="text" name="info[tag]" size="50" class="input-text" id="price" value="<?php echo $info['tag'];?>"><span class="onShow">多个标签请用一个空格分开</span></td>
                    </tr>
                    <tr>
                        <th width="100">半包价格：</th>
                        <td><input type="text" name="info[freeprice]" size="50" class="input-text" id="freeprice" value="<?php echo $info['freeprice'];?>"></td>
                    </tr>
                    <tr>
                        <th width="100">设计费：</th>
                        <td><input type="text" name="info[designprice]" size="50" class="input-text" id="designprice" value="<?php echo $info['designprice'];?>"></td>
                    </tr>
                    <tr>
                        <th width="100">促销：</th>
                        <td><input type="text" name="info[sales]" size="50" class="input-text" id="sales" value="<?php echo $info['sales'];?>"></td>
                    </tr>
                    <tr>
                        <th width="100">联系电话：</th>
                        <td><input type="text" name="info[phone]" size="50" class="input-text" id="phone" value="<?php echo $info['phone'];?>" ></td>
                    </tr>
                    <tr>
                        <th width="100">联系地址：</th>
                        <td><input type="text" name="info[address]" size="50" class="input-text" id="address" value="<?php echo $info['address'];?>" ></td>
                    </tr>
                    <tr>
                        <th width="100">是否显示：</th>
                        <td><input type="checkbox" name="info[confirm]" value="1" <?php if(!$id || $info['confirm'] == 1){?>checked="checked" <?php }?>></td>
                    </tr>
                    <tr>
                        <th width="100">样品房介绍：</th>
                        <td><textarea id="content" name="info[content]"> <?php echo $info['content']?></textarea><?php echo form::editor('content','full','','','',1,1)?></td>
                    </tr>
                    <!-- <tr>
                        <th width="100">施工工艺：</th>
                        <td><textarea id="craftwork" name="info[craftwork]"> <?php echo $info['craftwork']?></textarea><?php echo form::editor('craftwork','full','','','',1,1)?></td>
                    </tr>
                    <tr>
                        <th width="100">基础材料：</th>
                        <td><textarea id="basematerial" name="info[basematerial]"> <?php echo $info['basematerial']?></textarea><?php echo form::editor('basematerial','full','','','',1,1)?></td>
                    </tr>
                    <tr>
                        <th width="100">特色服务：</th>
                        <td><textarea id="service" name="info[service]"> <?php echo $info['service']?></textarea><?php echo form::editor('service','full','','','',1,1)?></td>
                    </tr> -->
                    <!-- <tr>
                        <th width="100">票数：</th>
                        <td><input type="text" name="info[votesnum]" size="30" class="input-text" id="votesnum" value="<?php echo $info['votesnum'];?>"></td>
                    </tr> -->
                    <!-- <tr>
                        <th width="100">报名人数：</th>
                        <td><input type="text" name="info[applynum]" size="30" class="input-text" id="applynum" value="<?php echo $info['applynum'];?>"></td>
                    </tr> -->
                   <!--  <tr>
                        <th width="100">缩略图：</th>
                        <td>
                            <script language="javascript" type="text/javascript" src="<?php echo JS_PATH;?>content_addtop.js"></script>
                            <script language="javascript" type="text/javascript" src="<?php echo JS_PATH;?>swfupload/swf2ckeditor.js"></script>
                            <div  class="upload-pic img-wrap" style="width:135px;">
                                <input type="hidden" name="info[thumb]" id="thumb" value="<?php echo $info['thumb'];?>">
                                <a href="javascript:void(0);" onclick="flashupload('thumb_images', '附件上传','thumb',thumb_images,'1,jpg|jpeg|gif|png|bmp,0,,,0','supermodel','6','<?php echo upload_key('1,jpg|jpeg|gif|png|bmp,0,,,0')?>');return false;">
                                    <img src="<?php echo $info['thumb'] ?  $info['thumb'] : IMG_PATH.'icon/upload-pic.png';?>" id="thumb_preview" width="135" height="113" style="cursor:hand"></a><input type="button" style="width: 66px;" class="button" onclick="$('#thumb_preview').attr('src','<?php echo IMG_PATH;?>icon/upload-pic.png');$('#thumb').val(' ');return false;" value="取消图片">
                            </div>
                        </td>
                    </tr> -->
                    <tr>
                        <th></th>
                        <td>
                            <input name="dosubmit" type="submit" value=" 提交 " class="button" id="dosubmit">
                            <input type="reset" value="重置" class="button">
                            <input type="button" onclick="history.go(-1)" value="后退" class="button">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

<!-- 编辑图片操作页面 -->
<?php }elseif (ROUTE_A == 'pic_add'){?>
<script>
$(function(){
    var oHimg=$('input[class="h-img"]'),
        intImg=oHimg.val(),
        timer=null;
        arr=new Array(),
        oImg=$('form[name="myform"]').find('img');
    timer=setInterval(function(){
        if(intImg!=oHimg.val()){
            // clearInterval(timer);
            var str=oHimg.val();
            arr=str.split('|');
            for (var i = 0; i < arr.length; i++) {
                oImg[i].setAttribute('src',arr[i]);
            };
            intImg=oHimg.val();
        }
    },800);


            var oForm=document.getElementById('myform'),
                oImg=oForm.getElementsByTagName('img'),
                oHidden=document.getElementById('tt-thumb'),t;
                oA=getByClass(oForm,'tt-a');
                // console.log(oA);
            for (var j = 0; j < oA.length; j++) {
                oA[j].index=j;
                oA[j].onclick=function(){
                    t=oImg[this.index].getAttribute('src');
                    for (var k = 0; k < oA.length; k++) {
                        oA[k].innerHTML='作为缩略图';
                    };
                    this.innerHTML='已设置';
                    oHidden.setAttribute('value',t);
                };
            };



});
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

    <div class="pad_10">
        <div class="common-form">
            <form name="myform" action="index.php?m=<?php echo ROUTE_M;?>&c=<?php echo ROUTE_C;?>&a=pic_add&id=<?php echo $id;?>&path=<?php echo $this->path;?>&pc_hash=<?php echo $_GET['pc_hash'];?>" method="post" id="myform">
                <table width="100%" class="table_form contentWrap">
                    <tr>
                        <th width="100">详情页滚动图：</th>
                        <td>
                            <script language="javascript" type="text/javascript" src="<?php echo JS_PATH;?>content_addtop.js"></script>
                            <script language="javascript" type="text/javascript" src="<?php echo JS_PATH;?>swfupload/swf2ckeditor.js"></script>
                            <input type="hidden" name="thumb" id="tt-thumb" value="">
                            <div  class="upload-pic img-wrap" style="width:135px; float:left;">
                                <input type="hidden" name="img[]" id="img" class="h-img" value="<?php echo $info['img'][0];?>">
                                <a href="javascript:void(0);" onclick="flashupload('thumb_images', '附件上传','img',thumb_images,'5,jpg|jpeg|gif|png|bmp,0,,,0','supermodel','6','<?php echo upload_key('5,jpg|jpeg|gif|png|bmp,0,,,0')?>');return false;">
                                    <img src="<?php echo $info['img'][0] ?  $info['img'][0] : IMG_PATH.'icon/upload-pic.png';?>" id="img_preview" width="135" height="113" style="cursor:hand">
                                </a>
                                <input type="button" style="width: 66px;" class="button" onclick="$('#img_preview').attr('src','<?php echo IMG_PATH;?>icon/upload-pic.png');$('#img').val(' ');return false;" value="取消图片">
                                <a href="javascript:;" class="tt-a">作为缩略图</a>
                                
                            </div>
                            <div  class="upload-pic img-wrap" style="width:135px; float:left;">
                                <input type="hidden" name="img[]" id="img2" value="<?php echo $info['img'][1];?>">
                                <a href="javascript:void(0);" onclick="flashupload('thumb_images', '附件上传','img2',thumb_images,'1,jpg|jpeg|gif|png|bmp,0,,,0','supermodel','6','<?php echo upload_key('1,jpg|jpeg|gif|png|bmp,0,,,0')?>');return false;">
                                    <img src="<?php echo $info['img'][1] ?  $info['img'][1] : IMG_PATH.'icon/upload-pic.png';?>" id="img2_preview" width="135" height="113" style="cursor:hand">
                                </a>
                                <input type="button" style="width: 66px;" class="button" onclick="$('#img2_preview').attr('src','<?php echo IMG_PATH;?>icon/upload-pic.png');$('#img2').val(' ');return false;" value="取消图片">
                                <a href="javascript:;" class="tt-a">作为缩略图</a>
                            </div>
                            <div  class="upload-pic img-wrap" style="width:135px; float:left;">
                                <input type="hidden" name="img[]" id="img3" value="<?php echo $info['img'][2];?>">
                                <a href="javascript:void(0);" onclick="flashupload('thumb_images', '附件上传','img3',thumb_images,'1,jpg|jpeg|gif|png|bmp,0,,,0','supermodel','6','<?php echo upload_key('1,jpg|jpeg|gif|png|bmp,0,,,0')?>');return false;">
                                    <img src="<?php echo $info['img'][2] ?  $info['img'][2] : IMG_PATH.'icon/upload-pic.png';?>" id="img3_preview" width="135" height="113" style="cursor:hand"></a>
                                    <input type="button" style="width: 66px;" class="button" onclick="$('#img3_preview').attr('src','<?php echo IMG_PATH;?>icon/upload-pic.png');$('#img3').val(' ');return false;" value="取消图片">
                                    <a href="javascript:;" class="tt-a">作为缩略图</a>
                            </div>
                            <div  class="upload-pic img-wrap" style="width:135px; float:left;">
                                <input type="hidden" name="img[]" id="img4" value="<?php echo $info['img'][3];?>">
                                <a href="javascript:void(0);" onclick="flashupload('thumb_images', '附件上传','img4',thumb_images,'1,jpg|jpeg|gif|png|bmp,0,,,0','supermodel','6','<?php echo upload_key('1,jpg|jpeg|gif|png|bmp,0,,,0')?>');return false;">
                                    <img src="<?php echo $info['img'][3] ?  $info['img'][3] : IMG_PATH.'icon/upload-pic.png';?>" id="img4_preview" width="135" height="113" style="cursor:hand"></a><input type="button" style="width: 66px;" class="button" onclick="$('#img4_preview').attr('src','<?php echo IMG_PATH;?>icon/upload-pic.png');$('#img4').val(' ');return false;" value="取消图片">
                                    <a href="javascript:;" class="tt-a">作为缩略图</a>
                            </div>
                            <div  class="upload-pic img-wrap" style="width:135px; float:left;">
                                <input type="hidden" name="img[]" id="img5" value="<?php echo $info['img'][4];?>">
                                <a href="javascript:void(0);" onclick="flashupload('thumb_images', '附件上传','img5',thumb_images,'1,jpg|jpeg|gif|png|bmp,0,,,0','supermodel','6','<?php echo upload_key('1,jpg|jpeg|gif|png|bmp,0,,,0')?>');return false;">
                                    <img src="<?php echo $info['img'][4] ?  $info['img'][4] : IMG_PATH.'icon/upload-pic.png';?>" id="img5_preview" width="135" height="113" style="cursor:hand"></a><input type="button" style="width: 66px;" class="button" onclick="$('#img5_preview').attr('src','<?php echo IMG_PATH;?>icon/upload-pic.png');$('#img5').val(' ');return false;" value="取消图片">
                                    <a href="javascript:;" class="tt-a">作为缩略图</a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            <input name="dosubmit" type="submit" value=" 提交 " class="button" id="dosubmit">
                            <input type="reset" value="重置" class="button">
                            <input type="button" onclick="history.go(-1)" value="后退" class="button">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

<?php }elseif (ROUTE_A == 'part_info'){?>

<div class="table-list pad-lr-10">
    <form action="index.php?m=<?php echo ROUTE_M?>&c=<?php echo ROUTE_C?>&a=apply_delete&path=<?php echo $_GET['path'];?>&pc_hash=<?php echo $_GET['pc_hash'];?>" id="myform" method="post">
        <table width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="50" align="center"><input type="checkbox" onclick="selectall('id[]');" id="check_box" value=""></th>
                        <th width="50" align="center">装饰公司</th>
                        <th width="200" align="center" >操作</th>
                    </tr>
                </thead>
                <?php foreach ($infos as $key=>$info){?>
                <tr>
                        <td align="center" ><input type="checkbox" value="<?php echo $info['id']?>" name="id[]" class="inputcheckbox "></td>
                        <td align="center" ><?php echo $info['name'];?></td>
                        <td align="center" >
                        <a href="?m=<?php echo ROUTE_M;?>&c=<?php echo ROUTE_C?>&a=part_modify&id=<?php echo $key?>&path=<?php echo $_GET['path']?>&pc_hash=<?php echo $_GET['pc_hash']?>">编辑</a>
                        </td>
                    </tr>
                <?php }?>
        </table>
        <div class="btn">
            <label for="check_box">全选/取消</label> &nbsp; 
            <input  type="submit" onclick="return confirm('确定要删除？');" class="button" name="dodelete" id="dodelete" value=" 删除 ">&nbsp;&nbsp;
        </div>
    </form>
    <div id="pages"><?php echo $pages?></div>
</div>

<?php }elseif (ROUTE_A == 'part_modify'){?>
    <div class="pad_10">
        <div class="common-form">
            <form name="myform" action="index.php?m=<?php echo ROUTE_M;?>&c=<?php echo ROUTE_C;?>&a=part_modify&id=<?php echo $id;?>&path=<?php echo $this->path;?>&pc_hash=<?php echo $_GET['pc_hash'];?>" method="post" id="myform">
                <table width="100%" class="table_form contentWrap">
                    <!-- <tr>
                        <th width="100">名称：</th>
                        <td><input type="text" name="info[name]" size="30" class="input-text" id="name" value="<?php echo $info['name'];?>"></td>
                    </tr> -->
                    <tr>
                        <th width="100">施工工艺：</th>
                        <td><textarea id="craftwork" name="info[craftwork]"> <?php echo $info['craftwork']?></textarea><?php echo form::editor('craftwork','full','','','',1,1)?></td>
                    </tr>
                    <tr>
                        <th width="100">基础材料：</th>
                        <td><textarea id="basematerial" name="info[basematerial]"> <?php echo $info['basematerial']?></textarea><?php echo form::editor('basematerial','full','','','',1,1)?></td>
                    </tr>
                    <tr>
                        <th width="100">特色服务：</th>
                        <td><textarea id="service" name="info[service]"> <?php echo $info['service']?></textarea><?php echo form::editor('service','full','','','',1,1)?></td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            <input name="dosubmit" type="submit" value=" 提交 " class="button" id="dosubmit">
                            <input type="reset" value="重置" class="button">
                            <input type="button" onclick="history.go(-1)" value="后退" class="button">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
<?php }?>