<?php 
defined('IN_ADMIN') or exit('No permission resources.');
$show_validator = true;
$show_header = false;
include $this->admin_tpl('header','admin');
?>

<!-- ������ -->
<div class="subnav">
    <div class="content-menu ib-a blue line-x">
        <a href="index.php?m=<?php echo ROUTE_M;?>&c=<?php echo ROUTE_C;?>&a=init&path=<?php echo $_GET['path']?>" <?php if(ROUTE_A == 'init'){?>class="on"<?php }?>>
            <em>�����б�</em>
        </a>
    <span>|</span>
        <a href="index.php?m=<?php echo ROUTE_M;?>&c=<?php echo ROUTE_C;?>&a=apply_add&path=<?php echo $_GET['path']?>" <?php if(ROUTE_A == 'apply_add'){?>class="on"<?php }?>>
            <em>���/�༭��������</em>
        </a>
    <span>|</span>
        <a href="index.php?m=<?php echo ROUTE_M;?>&c=<?php echo ROUTE_C;?>&a=players&path=<?php echo $_GET['path']?>" <?php if(ROUTE_A == 'players'){?>class="on"<?php }?>>
            <em>��Ʒ����Ϣ��</em>
        </a>
    <span>|</span>
        <a href="index.php?m=<?php echo ROUTE_M;?>&c=<?php echo ROUTE_C;?>&a=players_add&path=<?php echo $_GET['path']?>" <?php if(ROUTE_A == 'players_add'){?>class="on"<?php }?>>
            <em>���/�༭��Ʒ����Ϣ</em>
        </a>
    <span>|</span>
        <a href="index.php?m=<?php echo ROUTE_M;?>&c=<?php echo ROUTE_C;?>&a=part_info&path=<?php echo $_GET['path']?>" <?php if(ROUTE_A == 'part_info'){?>class="on"<?php }?>>
            <em>�̼���Ϣ</em>
        </a>
    <!-- <span>|</span>
        <a href="index.php?m=<?php echo ROUTE_M;?>&c=<?php echo ROUTE_C;?>&a=part_modify&path=<?php echo $_GET['path']?>" <?php if(ROUTE_A == 'part_modify'){?>class="on"<?php }?>>
            <em>�༭�̼���Ϣ</em>
        </a> -->
    </div>
</div>

<!-- �����б� -->
<?php if (ROUTE_A == 'init') {?>
<div class="pad-lr-10">
<div id="searchid">
<form name="searchform" id="searchform" action="" method="get" >
<input type="hidden" name="m" value="<?php echo ROUTE_M;?>">
<input type="hidden" name="c" value="<?php echo ROUTE_C;?>">
<input type="hidden" name="a" value="<?php echo ROUTE_A;?>">
<input type="hidden" name="path" value="<?php echo $_GET['path'];?>">

<!-- ������ -->
<table width="100%" cellspacing="0" class="search-form">
    <tbody>
		<tr>
			<td>
				<div class="explain-col">
				<!-- �����ؼ��֣�<input type="text" name="keyword" value="<?php echo $keyword;?>">&nbsp; -->
				�ؼ��֣�<input type="text" name="keyword1" value="<?php echo $keyword1;?>">&nbsp;
				���ʱ�䣺<?php echo form::date('starttime', $_GET['starttime'] , 0 , 0, 'false');?>- &nbsp;<?php echo form::date('endtime', $_GET['endtime'], 0, 0, 'false');?>
				<input type="hidden" name="status" value="1">
				<input type="submit" name="dosearch" class="button" value=" ���� " />
				</div>
			</td>
		</tr>
    </tbody>
</table>
</form>
</div>
<div style="height:20px;line-height:20px;padding-left:10px;margin-bottom:10px;">
	����<?php if($condition){echo '<span style="color:red;font-weight:bold;">��'.$condition.'��</span>';}?>�����ļ�¼��<span style="color:red;font-weight:bold;"><?php echo $counts?></span>��
	&nbsp;
	<?php if($condition){?>[<a href="index.php?m=<?php echo ROUTE_M;?>&c=<?php echo ROUTE_C;?>&a=<?php echo ROUTE_A;?>&path=<?php echo $_GET['path'];?>">�����������</a>]
    <?php }?>
</div>

<!-- main -->
<div class="table-list pad-lr-10">
    <form action="index.php?m=<?php echo ROUTE_M?>&c=<?php echo ROUTE_C?>&a=apply_delete&path=<?php echo $_GET['path'];?>&pc_hash=<?php echo $_GET['pc_hash'];?>" id="myform" method="post">
        <table width="100%" cellspacing="0">
                <thead>
        			<tr>
        				<th width="50" align="center"><input type="checkbox" onclick="selectall('id[]');" id="check_box" value=""></th>
                        <th width="50" align="center">����</th>
        				<th width="100" align="center">�绰</th>
        				<th width="100" align="center" >С������</th>
        				<th width="30" align="center">ʹ�����</th>
        				<th width="200" align="center" >��Դ</th>
        				<th width="50" align="center">��������</th>
        				<th width="200" align="center" >����</th>
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
                        <!-- <a href="javascript:window.top.art.dialog({id:'add',content:'<?php if($info['thumb']){ ?><img width=\'1024\' height=\'768\' src=\'<?php echo $info['thumb'];?>\' /><?php }else{echo 'û��ͼƬ';}?>', title:'��ƷͼƬ', width:'1024', height:'768', lock:false}, function(){var d = window.top.art.dialog({id:'add'}).data.iframe;var form = d.document.getElementById('dosubmit');form.click();return false;}, function(){window.top.art.dialog({id:'add'}).close()});void(0);">�鿴��ƷͼƬ</a>&nbsp;&nbsp;|&nbsp;&nbsp; -->
                        <a href="?m=<?php echo ROUTE_M;?>&c=<?php echo ROUTE_C?>&a=apply_add&id=<?php echo $info['id']?>&path=<?php echo $_GET['path']?>&pc_hash=<?php echo $_GET['pc_hash']?>">�༭</a>&nbsp;&nbsp;|&nbsp;&nbsp;
        				<a onclick="return confirm('ȷ��ɾ����');" href="index.php?m=<?php echo ROUTE_M;?>&c=<?php echo ROUTE_C;?>&a=apply_delete&path=<?php echo $_GET['path']?>&id=<?php echo $info['id']?>&pc_hash=<?php echo $_GET['pc_hash']?>">ɾ��</a><br>
        				</td>
        			</tr>
                <?php }?>
        </table>
        <div class="btn">
            <label for="check_box">ȫѡ/ȡ��</label> &nbsp; 
            <input  type="submit" onclick="return confirm('ȷ��Ҫɾ����');" class="button" name="dodelete" id="dodelete" value=" ɾ�� ">&nbsp;&nbsp;
        </div>
    </form>
    <div id="pages"><?php echo $pages?></div>
</div>

<!-- ��Ʒ����Ϣ�� -->
<?php }elseif(ROUTE_A == 'players'){?>
<!-- ������ -->
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
                �ؼ��֣�<input type="text" name="keyword1" value="<?php echo $keyword1;?>">&nbsp;
                װ�ι�˾��  <select name="keyword2">
                                <option value=""></option>
                                <option value="1">�Ͼ�װ��</option>
                                <option value="2">�װ�װ��</option>
                                <option value="3">����װ��</option>
                                <option value="4">����װ��</option>
                                <option value="5">�ʳ�װ��</option>
                            </select>&nbsp;
                ���ʱ�䣺<?php echo form::date('starttime', $_GET['starttime'] , 0 , 0, 'false');?>- &nbsp;<?php echo form::date('endtime', $_GET['endtime'], 0, 0, 'false');?>
                <input type="hidden" name="status" value="1">
                <input type="submit" name="dosearch" class="button" value=" ���� " />
                </div>
            </td>
        </tr>
    </tbody>
</table>
</form>
</div>
<div style="height:20px;line-height:20px;padding-left:10px;margin-bottom:10px;">
    ����<?php if($condition){echo '<span style="color:red;font-weight:bold;">��'.$condition.'��</span>';}?>�����ļ�¼��<span style="color:red;font-weight:bold;"><?php echo $counts?></span>��
    &nbsp;
    <?php if($condition){?>[<a href="index.php?m=<?php echo ROUTE_M;?>&c=<?php echo ROUTE_C;?>&a=<?php echo ROUTE_A;?>&path=<?php echo $_GET['path'];?>">�����������</a>]
    <?php }?>
</div>

    <div class="table-list pad-lr-10">
        <form action="index.php?m=<?php echo ROUTE_M?>&c=<?php echo ROUTE_C?>&a=players_delete&path=<?php echo $_GET['path'];?>&pc_hash=<?php echo $_GET['pc_hash'];?>" id="myform" method="post">
            <table width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th width="50" align="center"><input type="checkbox" onclick="selectall('id[]');" id="check_box" value=""></th>
                    <th width="50" align="center">��Ʒ�������</th>
                    <!-- <th width="50" align="center">���</th> -->
                    <th width="100" align="center" >¥������</th>
                    <!-- <th width="50" align="center" >�������</th>
                    <th width="50" align="center" >ʵ�����</th>
                    <th width="50" align="center" >���ͽṹ</th> -->
                    <th width="50" align="center" >ʩ����λ</th>
                    <!-- <th width="50" align="center" >��Ҫ����</th>
                    <th width="50" align="center" >��Ŀ���</th>
                    <th width="50" align="center" >��ϵ��ʽ</th>
                    <th width="50" align="center" >��ϵ��ַ</th> -->
<!--                     <th width="100" align="center" >��Ʒ������</th> -->
                    <!-- <th width="50" align="center" >Ʊ��</th> -->
                    <th width="50" align="center" >��������</th>
                    <th width="50" align="center" >�����</th>
                    <!-- <th width="50" align="center" >����۸�</th>
                    <th width="50" align="center" >��Ʒ�</th>
                    <th width="50" align="center" >����</th> -->
                    <!-- <th width="50" align="center" >�Ƿ���ʾ</th> -->
                    <th width="50" align="center" >����</th>
                    <th width="200" align="center" >����</th>
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
                            
                            <a href="?m=<?php echo ROUTE_M;?>&c=<?php echo ROUTE_C?>&a=pic_add&id=<?php echo $info['id']?>&path=<?php echo $_GET['path']?>&pc_hash=<?php echo $_GET['pc_hash']?>">�༭ͼƬ</a>&nbsp;&nbsp;|&nbsp;&nbsp;

                            <a href="?m=<?php echo ROUTE_M;?>&c=<?php echo ROUTE_C?>&a=players_add&id=<?php echo $info['id']?>&path=<?php echo $_GET['path']?>&pc_hash=<?php echo $_GET['pc_hash']?>">�༭</a>&nbsp;&nbsp;|&nbsp;&nbsp;

                            <a onclick="return confirm('ȷ��ɾ����');" href="index.php?m=<?php echo ROUTE_M;?>&c=<?php echo ROUTE_C;?>&a=players_delete&path=<?php echo $_GET['path']?>&id=<?php echo $info['id']?>&pc_hash=<?php echo $_GET['pc_hash']?>">ɾ��</a>
                            <br>
                        </td>
                    </tr>
                <?php }?>
            </table>
            <div class="btn">
                <label for="check_box">ȫѡ/ȡ��</label> &nbsp;
                <input  type="submit" onclick="return confirm('ȷ��Ҫɾ����');" class="button" name="dodelete" id="dodelete" value=" ɾ�� ">&nbsp;&nbsp;
            </div>
        </form>
        <div id="pages"><?php echo $pages?></div>
    </div>

<!-- ��ǡ���ӱ����б� -->
<?php }elseif (ROUTE_A == 'apply_add'){?>
    <script type="text/javascript">
        $(function(){
            $.formValidator.initConfig({autotip:true,formid:"myform",onerror:function(msg){}});
            var check_array = new Array('name','phone','areaname','usearea');
            for(var i = 0; i < check_array.length;i++){
                $('#'+check_array[i]).formValidator({onshow:'������',onfocus:'����Ϊ��'}).inputValidator({min:1,onerror:'����Ϊ��'});
            }
        });
    </script>
    <div class="pad_10">
        <div class="common-form">
            <form name="myform" action="index.php?m=<?php echo ROUTE_M;?>&c=<?php echo ROUTE_C;?>&a=apply_add&id=<?php echo $id;?>&path=<?php echo $this->path;?>&pc_hash=<?php echo $_GET['pc_hash'];?>" method="post" id="myform">
                <table width="100%" class="table_form contentWrap">
                    <tr>
                        <th width="100">���ƣ�</th>
                        <td><input type="text" name="info[name]" size="30" class="input-text" id="name" value="<?php echo $info['name'];?>"></td>
                    </tr>
                    <tr>
                        <th width="100">�绰��</th>
                        <td><input type="text" name="info[phone]" size="30" class="input-text" id="phone" value="<?php echo $info['phone'];?>"></td>
                    </tr>
                    <tr>
                        <th width="100">С�����֣�</th>
                        <td><input type="text" name="info[areaname]" size="30" class="input-text" id="areaname" value="<?php echo $info['areaname'];?>"></td>
                    </tr>
                    <tr>
                        <th width="100">ʵ�������</th>
                        <td><input type="text" name="info[usearea]" size="30" class="input-text" id="usearea" value="<?php echo $info['usearea'];?>"></td>
                    </tr>
                    <tr>
                        <th width="100">�Ƿ���ʾ��</th>
                        <td><input type="checkbox" name="info[confirm]" value="1" <?php if(!$id || $info['confirm'] == 1){?>checked="checked" <?php }?>></td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            <input name="dosubmit" type="submit" value=" �ύ " class="button" id="dosubmit">
                            <input type="reset" value="����" class="button">
                            <input type="button" onclick="history.go(-1)" value="����" class="button">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

<!-- �༭�������Ʒ����Ϣ -->
<?php }elseif (ROUTE_A == 'players_add'){?>
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH;?>house_admin.css">
    <script type="text/javascript">
        $(function(){
            $.formValidator.initConfig({autotip:true,formid:"myform",onerror:function(msg){}});
            var check_array = new Array('title','bulidname');
            for(var i = 0; i < check_array.length;i++){
                $('#'+check_array[i]).formValidator({onshow:'������',onfocus:'����Ϊ��'}).inputValidator({min:1,onerror:'����Ϊ��'});
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
                $('input[id="address"]').attr('value','���ϰ��ݴ��������ٹ㳡1208��');
                break;
            case 2:
                $('input[id="phone"]').attr('value','0752-5787517');
                $('input[id="address"]').attr('value','�ݳ������������ٹ㳡2416-2420��');
                break;
            case 3:
                $('input[id="phone"]').attr('value','0750-2666662');
                $('input[id="address"]').attr('value','���ϰ��ݴ�һ·��������ײ�1-2������');
                break;
            case 4:
                $('input[id="phone"]').attr('value','13751570338');
                $('input[id="address"]').attr('value','����԰53�Ŵ�����������505��');
                break;
            case 5:
                $('input[id="phone"]').attr('value','0752-2211709');
                $('input[id="address"]').attr('value','���ϰ��ݴ���19��������������5��01��');
                break;
           }
        }

    </script>

    <div class="pad_10">
        <div class="common-form">
            <form name="myform" action="index.php?m=<?php echo ROUTE_M;?>&c=<?php echo ROUTE_C;?>&a=players_add&id=<?php echo $id;?>&path=<?php echo $this->path;?>&pc_hash=<?php echo $_GET['pc_hash'];?>" method="post" id="myform">
                <table width="100%" class="table_form contentWrap">
                    <tr>
                        <th width="100">��Ʒ������⣺</th>
                        <td><input type="text" name="info[title]" size="50" class="input-text" id="title" value="<?php echo $info['title'];?>"></td>
                    </tr>
                    <tr>
                        <th width="100">��Ʒ����ţ�</th>
                        <td><input type="text" name="info[no]" size="50" class="input-text" id="no" value="<?php echo $info['no'];?>"></td>
                    </tr>
                    <tr>
                        <th width="100">¥�����ƣ�</th>
                        <td><input type="text" name="info[bulidname]" size="50" class="input-text" id="bulidname" value="<?php echo $info['bulidname'];?>"></td>
                    </tr>
                    <tr>
                        <th width="100">���������</th>
                        <td><input type="text" name="info[bulidarea]" size="50" class="input-text" id="bulidarea" value="<?php echo $info['bulidarea'];?>"></td>
                    </tr>
                    <tr>
                        <th width="100">ʵ�������</th>
                        <td><input type="text" name="info[usearea]" size="50" class="input-text" id="usearea" value="<?php echo $info['usearea'];?>"></td>
                    </tr>
                    <tr>
                        <th width="100">���ͽṹ��</th>
                        <td><input type="text" name="info[housestyle]" size="50" class="input-text" id="housestyle" value="<?php echo $info['housestyle'];?>"></td>  
                    </tr>
                    <tr>
                        <th width="100">ʩ����λ��</th>
                        <!-- <td><input type="text" name="info[constrpart]" size="50" class="input-text" id="constrpart" value="<?php echo $info['constrpart'];?>"></td> -->
                        <td>
                            <select name="info[constrpart]" id="constrpart" class="constrpart" onchange="DoChange(this.value);">
                                <option value="">��ѡ��</option>
                                <option value="1"  id="woju">�Ͼ�װ��</option>
                                <option value="2" id="yibai">�װ�װ��</option>
                                <option value="3" id="huaning">����װ��</option>
                                <option value="4" id="sanxing">����װ��</option>
                                <option value="5" id="huangcheng">�ʳ�װ��</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th width="100">��Ҫ���ϣ�</th>
                        <td><input type="text" name="info[material]" size="50" class="input-text" id="material" value="<?php echo $info['material'];?>"></td>
                    </tr>
                    <tr>
                        <th width="100">��Ŀ��ۣ�</th>
                        <td><input type="text" name="info[price]" size="50" class="input-text" id="price" value="<?php echo $info['price'];?>"></td>
                    </tr>
                    <tr>
                        <th width="100">��ǩ��</th>
                        <td><input type="text" name="info[tag]" size="50" class="input-text" id="price" value="<?php echo $info['tag'];?>"><span class="onShow">�����ǩ����һ���ո�ֿ�</span></td>
                    </tr>
                    <tr>
                        <th width="100">����۸�</th>
                        <td><input type="text" name="info[freeprice]" size="50" class="input-text" id="freeprice" value="<?php echo $info['freeprice'];?>"></td>
                    </tr>
                    <tr>
                        <th width="100">��Ʒѣ�</th>
                        <td><input type="text" name="info[designprice]" size="50" class="input-text" id="designprice" value="<?php echo $info['designprice'];?>"></td>
                    </tr>
                    <tr>
                        <th width="100">������</th>
                        <td><input type="text" name="info[sales]" size="50" class="input-text" id="sales" value="<?php echo $info['sales'];?>"></td>
                    </tr>
                    <tr>
                        <th width="100">��ϵ�绰��</th>
                        <td><input type="text" name="info[phone]" size="50" class="input-text" id="phone" value="<?php echo $info['phone'];?>" ></td>
                    </tr>
                    <tr>
                        <th width="100">��ϵ��ַ��</th>
                        <td><input type="text" name="info[address]" size="50" class="input-text" id="address" value="<?php echo $info['address'];?>" ></td>
                    </tr>
                    <tr>
                        <th width="100">�Ƿ���ʾ��</th>
                        <td><input type="checkbox" name="info[confirm]" value="1" <?php if(!$id || $info['confirm'] == 1){?>checked="checked" <?php }?>></td>
                    </tr>
                    <tr>
                        <th width="100">��Ʒ�����ܣ�</th>
                        <td><textarea id="content" name="info[content]"> <?php echo $info['content']?></textarea><?php echo form::editor('content','full','','','',1,1)?></td>
                    </tr>
                    <!-- <tr>
                        <th width="100">ʩ�����գ�</th>
                        <td><textarea id="craftwork" name="info[craftwork]"> <?php echo $info['craftwork']?></textarea><?php echo form::editor('craftwork','full','','','',1,1)?></td>
                    </tr>
                    <tr>
                        <th width="100">�������ϣ�</th>
                        <td><textarea id="basematerial" name="info[basematerial]"> <?php echo $info['basematerial']?></textarea><?php echo form::editor('basematerial','full','','','',1,1)?></td>
                    </tr>
                    <tr>
                        <th width="100">��ɫ����</th>
                        <td><textarea id="service" name="info[service]"> <?php echo $info['service']?></textarea><?php echo form::editor('service','full','','','',1,1)?></td>
                    </tr> -->
                    <!-- <tr>
                        <th width="100">Ʊ����</th>
                        <td><input type="text" name="info[votesnum]" size="30" class="input-text" id="votesnum" value="<?php echo $info['votesnum'];?>"></td>
                    </tr> -->
                    <!-- <tr>
                        <th width="100">����������</th>
                        <td><input type="text" name="info[applynum]" size="30" class="input-text" id="applynum" value="<?php echo $info['applynum'];?>"></td>
                    </tr> -->
                   <!--  <tr>
                        <th width="100">����ͼ��</th>
                        <td>
                            <script language="javascript" type="text/javascript" src="<?php echo JS_PATH;?>content_addtop.js"></script>
                            <script language="javascript" type="text/javascript" src="<?php echo JS_PATH;?>swfupload/swf2ckeditor.js"></script>
                            <div  class="upload-pic img-wrap" style="width:135px;">
                                <input type="hidden" name="info[thumb]" id="thumb" value="<?php echo $info['thumb'];?>">
                                <a href="javascript:void(0);" onclick="flashupload('thumb_images', '�����ϴ�','thumb',thumb_images,'1,jpg|jpeg|gif|png|bmp,0,,,0','supermodel','6','<?php echo upload_key('1,jpg|jpeg|gif|png|bmp,0,,,0')?>');return false;">
                                    <img src="<?php echo $info['thumb'] ?  $info['thumb'] : IMG_PATH.'icon/upload-pic.png';?>" id="thumb_preview" width="135" height="113" style="cursor:hand"></a><input type="button" style="width: 66px;" class="button" onclick="$('#thumb_preview').attr('src','<?php echo IMG_PATH;?>icon/upload-pic.png');$('#thumb').val(' ');return false;" value="ȡ��ͼƬ">
                            </div>
                        </td>
                    </tr> -->
                    <tr>
                        <th></th>
                        <td>
                            <input name="dosubmit" type="submit" value=" �ύ " class="button" id="dosubmit">
                            <input type="reset" value="����" class="button">
                            <input type="button" onclick="history.go(-1)" value="����" class="button">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

<!-- �༭ͼƬ����ҳ�� -->
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
                        oA[k].innerHTML='��Ϊ����ͼ';
                    };
                    this.innerHTML='������';
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
                        <th width="100">����ҳ����ͼ��</th>
                        <td>
                            <script language="javascript" type="text/javascript" src="<?php echo JS_PATH;?>content_addtop.js"></script>
                            <script language="javascript" type="text/javascript" src="<?php echo JS_PATH;?>swfupload/swf2ckeditor.js"></script>
                            <input type="hidden" name="thumb" id="tt-thumb" value="">
                            <div  class="upload-pic img-wrap" style="width:135px; float:left;">
                                <input type="hidden" name="img[]" id="img" class="h-img" value="<?php echo $info['img'][0];?>">
                                <a href="javascript:void(0);" onclick="flashupload('thumb_images', '�����ϴ�','img',thumb_images,'5,jpg|jpeg|gif|png|bmp,0,,,0','supermodel','6','<?php echo upload_key('5,jpg|jpeg|gif|png|bmp,0,,,0')?>');return false;">
                                    <img src="<?php echo $info['img'][0] ?  $info['img'][0] : IMG_PATH.'icon/upload-pic.png';?>" id="img_preview" width="135" height="113" style="cursor:hand">
                                </a>
                                <input type="button" style="width: 66px;" class="button" onclick="$('#img_preview').attr('src','<?php echo IMG_PATH;?>icon/upload-pic.png');$('#img').val(' ');return false;" value="ȡ��ͼƬ">
                                <a href="javascript:;" class="tt-a">��Ϊ����ͼ</a>
                                
                            </div>
                            <div  class="upload-pic img-wrap" style="width:135px; float:left;">
                                <input type="hidden" name="img[]" id="img2" value="<?php echo $info['img'][1];?>">
                                <a href="javascript:void(0);" onclick="flashupload('thumb_images', '�����ϴ�','img2',thumb_images,'1,jpg|jpeg|gif|png|bmp,0,,,0','supermodel','6','<?php echo upload_key('1,jpg|jpeg|gif|png|bmp,0,,,0')?>');return false;">
                                    <img src="<?php echo $info['img'][1] ?  $info['img'][1] : IMG_PATH.'icon/upload-pic.png';?>" id="img2_preview" width="135" height="113" style="cursor:hand">
                                </a>
                                <input type="button" style="width: 66px;" class="button" onclick="$('#img2_preview').attr('src','<?php echo IMG_PATH;?>icon/upload-pic.png');$('#img2').val(' ');return false;" value="ȡ��ͼƬ">
                                <a href="javascript:;" class="tt-a">��Ϊ����ͼ</a>
                            </div>
                            <div  class="upload-pic img-wrap" style="width:135px; float:left;">
                                <input type="hidden" name="img[]" id="img3" value="<?php echo $info['img'][2];?>">
                                <a href="javascript:void(0);" onclick="flashupload('thumb_images', '�����ϴ�','img3',thumb_images,'1,jpg|jpeg|gif|png|bmp,0,,,0','supermodel','6','<?php echo upload_key('1,jpg|jpeg|gif|png|bmp,0,,,0')?>');return false;">
                                    <img src="<?php echo $info['img'][2] ?  $info['img'][2] : IMG_PATH.'icon/upload-pic.png';?>" id="img3_preview" width="135" height="113" style="cursor:hand"></a>
                                    <input type="button" style="width: 66px;" class="button" onclick="$('#img3_preview').attr('src','<?php echo IMG_PATH;?>icon/upload-pic.png');$('#img3').val(' ');return false;" value="ȡ��ͼƬ">
                                    <a href="javascript:;" class="tt-a">��Ϊ����ͼ</a>
                            </div>
                            <div  class="upload-pic img-wrap" style="width:135px; float:left;">
                                <input type="hidden" name="img[]" id="img4" value="<?php echo $info['img'][3];?>">
                                <a href="javascript:void(0);" onclick="flashupload('thumb_images', '�����ϴ�','img4',thumb_images,'1,jpg|jpeg|gif|png|bmp,0,,,0','supermodel','6','<?php echo upload_key('1,jpg|jpeg|gif|png|bmp,0,,,0')?>');return false;">
                                    <img src="<?php echo $info['img'][3] ?  $info['img'][3] : IMG_PATH.'icon/upload-pic.png';?>" id="img4_preview" width="135" height="113" style="cursor:hand"></a><input type="button" style="width: 66px;" class="button" onclick="$('#img4_preview').attr('src','<?php echo IMG_PATH;?>icon/upload-pic.png');$('#img4').val(' ');return false;" value="ȡ��ͼƬ">
                                    <a href="javascript:;" class="tt-a">��Ϊ����ͼ</a>
                            </div>
                            <div  class="upload-pic img-wrap" style="width:135px; float:left;">
                                <input type="hidden" name="img[]" id="img5" value="<?php echo $info['img'][4];?>">
                                <a href="javascript:void(0);" onclick="flashupload('thumb_images', '�����ϴ�','img5',thumb_images,'1,jpg|jpeg|gif|png|bmp,0,,,0','supermodel','6','<?php echo upload_key('1,jpg|jpeg|gif|png|bmp,0,,,0')?>');return false;">
                                    <img src="<?php echo $info['img'][4] ?  $info['img'][4] : IMG_PATH.'icon/upload-pic.png';?>" id="img5_preview" width="135" height="113" style="cursor:hand"></a><input type="button" style="width: 66px;" class="button" onclick="$('#img5_preview').attr('src','<?php echo IMG_PATH;?>icon/upload-pic.png');$('#img5').val(' ');return false;" value="ȡ��ͼƬ">
                                    <a href="javascript:;" class="tt-a">��Ϊ����ͼ</a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            <input name="dosubmit" type="submit" value=" �ύ " class="button" id="dosubmit">
                            <input type="reset" value="����" class="button">
                            <input type="button" onclick="history.go(-1)" value="����" class="button">
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
                        <th width="50" align="center">װ�ι�˾</th>
                        <th width="200" align="center" >����</th>
                    </tr>
                </thead>
                <?php foreach ($infos as $key=>$info){?>
                <tr>
                        <td align="center" ><input type="checkbox" value="<?php echo $info['id']?>" name="id[]" class="inputcheckbox "></td>
                        <td align="center" ><?php echo $info['name'];?></td>
                        <td align="center" >
                        <a href="?m=<?php echo ROUTE_M;?>&c=<?php echo ROUTE_C?>&a=part_modify&id=<?php echo $key?>&path=<?php echo $_GET['path']?>&pc_hash=<?php echo $_GET['pc_hash']?>">�༭</a>
                        </td>
                    </tr>
                <?php }?>
        </table>
        <div class="btn">
            <label for="check_box">ȫѡ/ȡ��</label> &nbsp; 
            <input  type="submit" onclick="return confirm('ȷ��Ҫɾ����');" class="button" name="dodelete" id="dodelete" value=" ɾ�� ">&nbsp;&nbsp;
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
                        <th width="100">���ƣ�</th>
                        <td><input type="text" name="info[name]" size="30" class="input-text" id="name" value="<?php echo $info['name'];?>"></td>
                    </tr> -->
                    <tr>
                        <th width="100">ʩ�����գ�</th>
                        <td><textarea id="craftwork" name="info[craftwork]"> <?php echo $info['craftwork']?></textarea><?php echo form::editor('craftwork','full','','','',1,1)?></td>
                    </tr>
                    <tr>
                        <th width="100">�������ϣ�</th>
                        <td><textarea id="basematerial" name="info[basematerial]"> <?php echo $info['basematerial']?></textarea><?php echo form::editor('basematerial','full','','','',1,1)?></td>
                    </tr>
                    <tr>
                        <th width="100">��ɫ����</th>
                        <td><textarea id="service" name="info[service]"> <?php echo $info['service']?></textarea><?php echo form::editor('service','full','','','',1,1)?></td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            <input name="dosubmit" type="submit" value=" �ύ " class="button" id="dosubmit">
                            <input type="reset" value="����" class="button">
                            <input type="button" onclick="history.go(-1)" value="����" class="button">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
<?php }?>