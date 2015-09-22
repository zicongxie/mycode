<?php
defined('IN_PHPCMS') or exit('No permission resources.');
pc_base::load_app_class('admin','admin',0);

class house_201506_admin extends admin{
	function __construct() {
		$this->path = $_GET['path'];
		$this->apply_db = pc_base::load_model('apply_model');
		$this->players_db = pc_base::load_model('players_model');
		
		$this->style_array = array(
				1=>'三室两厅',
				2=>'三室两厅',
				3=>'三室两厅',
				4=>'三室两厅',
				5=>'三室两厅',
		);
		
		pc_base::load_sys_class('form', '', 0);
		parent::__construct();
	}
	/*---------------------------------------------------报名列表--------------------------------------------------------------*/
	function init(){
		$where = $orderby = $condition = '';
		if((isset($_GET['starttime']) && !empty($_GET['starttime']))){
			$starttime = strtotime($_GET['starttime']);
			$where .= ($where ? ' AND ' : '').'`dateline` > '.$starttime;
            $condition .= ($condition ? '+' : '').$_GET['starttime'];
		}
		if (isset($_GET['endtime']) && !empty($_GET['endtime'])){
			$endtime = strtotime($_GET['endtime']) + 86400;
			$where .= ($where ? ' AND ' : '').'`dateline` < '.$endtime;
            $condition .= ($condition ? '+' : '').$_GET['endtime'];
		}
		//作品名称关键字
		// if (isset($_GET['keyword']) && !empty($_GET['keyword'])){
		// 	$keyword = $_GET['keyword'];
  //           $keyword = safe_replace($keyword);
		// 	$keyword = htmlspecialchars(strip_tags($keyword));
		// 	$where .= ($where ? ' AND ' : '')."`realname` LIKE '%$keyword%'";
  //           $condition .= ($condition ? '+' : '').$keyword;
		// }
		if (isset($_GET['keyword1']) && !empty($_GET['keyword1'])){
			$keyword1 = $_GET['keyword1'];
            $keyword1 = safe_replace($keyword1);
			$keyword1 = htmlspecialchars(strip_tags($keyword1), ENT_COMPAT, 'GB2312');
			$where .= ($where ? ' AND ' : '')."`phone` LIKE '%$keyword1%' OR `name` LIKE '%$keyword1%' OR `areaname` LIKE '%$keyword1%' OR `source` LIKE '%$keyword1%'";
            $condition .= ($condition ? '+' : '').$keyword1;
		}
		
		$page = max(1,intval($_GET['page']));
		$infos = $this->apply_db->listinfo($where,'`dateline` DESC',$page,20);
		$counts = $this->apply_db->count($where);
		$pages = $this->apply_db->pages;
		include $this->admin_tpl('index');
	}
// 	/*---------------------------------------------------投票----------------------------------------------------------------*/
// 	function votes(){
		
// 		$where = $orderby = $condition = '';
// 		if((isset($_GET['starttime']) && !empty($_GET['starttime']))){
// 			$starttime = strtotime($_GET['starttime']);
// 			$where .= ($where ? ' AND ' : '').'`dateline` > '.$starttime;
//             $condition .= ($condition ? '+' : '').$_GET['starttime'];
// 		}
// 		if (isset($_GET['endtime']) && !empty($_GET['endtime'])){
// 			$endtime = strtotime($_GET['endtime']) + 86400;
// 			$where .= ($where ? ' AND ' : '').'`dateline` < '.$endtime;
//             $condition .= ($condition ? '+' : '').$_GET['endtime'];
// 		}
		
// 		//标题关键字
// 		if (isset($_GET['keyword']) && !empty($_GET['keyword'])){
// 			$keyword = $_GET['keyword'];
//             $keyword = safe_replace($keyword);
// 			$keyword = htmlspecialchars(strip_tags($keyword));
// 			$where .= ($where ? ' AND ' : '')."`uid` LIKE '%$keyword%'";
//             $condition .= ($condition ? '+' : '').$keyword;
// 		}
// 		if (isset($_GET['keyword1']) && !empty($_GET['keyword1'])){
// 			$keyword1 = $_GET['keyword1'];
//             $keyword1 = safe_replace($keyword1);
// 			$keyword1 = htmlspecialchars(strip_tags($keyword1));
// 			$where .= ($where ? ' AND ' : '')."`ip` LIKE '%$keyword1%'";
//             $condition .= ($condition ? '+' : '').$keyword1;
// 		}
// 		if (isset($_GET['keyword2']) && !empty($_GET['keyword2'])){
// 			$keyword2 = $_GET['keyword2'];
//             $keyword2 = safe_replace($keyword2);
// 			$keyword2 = htmlspecialchars(strip_tags($keyword2));
// 			$where .= ($where ? ' AND ' : '')."`aid` = '$keyword2'";
//             $condition .= ($condition ? '+' : '').$keyword2;
// 		}
// 		if (isset($_GET['keyword3']) && !empty($_GET['keyword3'])){
// 			$keyword3 = $_GET['keyword3'];
//             $keyword3 = safe_replace($keyword3);
// 			$keyword3 = htmlspecialchars(strip_tags($keyword3));
// 			$where .= ($where ? ' AND ' : '')."`username` LIKE '%$keyword3%'";
//             $condition .= ($condition ? '+' : '').$keyword3;
// 		}
		
// 		$page = max(1,intval($_GET['page']));
// 		$infos = $this->votes_db->listinfo($where,'`dateline` DESC',$page,10);
// 		$counts = $this->votes_db->count($where);
// 		$pages = $this->votes_db->pages;
// 		include $this->admin_tpl('index');
// 	}
// 	/*---------------------------------------------------删除----------------------------------------------------------------*/
// 	function votes_delete(){
// 		if (isset($_POST['dodelete']) && !empty($_POST['dodelete']) || $_GET['id']){
// 			if((!isset($_GET['id']) || empty($_GET['id'])) && (!isset($_POST['id']) || empty($_POST['id']))) {
// 				showmessage('非法操作！','index.php?m='.ROUTE_M.'&c='.ROUTE_C.'&a=init&path='.$this->path.'&pc_hash='.$_GET['pc_hash']);
// 			} else {
// 				if(is_array($_POST['id'])){
// 					foreach($_POST['id'] as $id) {
// 						$this->votes_db->delete(array('id'=>$id));
// 				}
// 				showmessage('操作成功！','index.php?m='.ROUTE_M.'&c='.ROUTE_C.'&a=votes&path='.$this->path.'&pc_hash='.$_GET['pc_hash']);
// 				}else{
// 					$id = intval($_GET['id']);
// 					if($id < 1) return false;
// 					$this->votes_db->delete(array('id'=>$id));
// 					showmessage('操作成功！','index.php?m='.ROUTE_M.'&c='.ROUTE_C.'&a=votes&path='.$this->path.'&pc_hash='.$_GET['pc_hash']);
// 				}
// 			}
// 		}
// 	}
    /*---------------------------------------------------添加报名纪录--------------------------------------------------------------*/
    function apply_add(){
        $id = intval($_GET['id']);
        if(isset($_POST['dosubmit']) && !empty($_POST['dosubmit'])){
            $filter_array = array('name','phone','areaname','usearea');
            foreach($filter_array as $val){
                $_POST['info'][$val] = new_html_entity_decode(strip_tags(trim($_POST['info'][$val])));
            }

            $_POST['info']['confirm'] = $_POST['info']['confirm'] ? intval($_POST['info']['confirm']) : 0;

            if($id){
                $this->apply_db->update($_POST['info'],'`id` = '.$id);
            }else{
                $_POST['info']['dateline'] = SYS_TIME;
                $this->apply_db->insert($_POST['info']);
            }
            showmessage('操作成功','index.php?m='.ROUTE_M.'&c='.ROUTE_C.'&a=init&path='.$this->path.'&pc_hash='.$_GET['pc_hash']);
        }else{
            if($id){
                $info = $this->apply_db->get_one('`id` = '.$id);
            }
            include $this->admin_tpl('index');
        }
    }
	/*---------------------------------------------------删除报名纪录--------------------------------------------------------------*/
	function apply_delete(){
		if (isset($_POST['dodelete']) && !empty($_POST['dodelete']) || $_GET['id']){
			if((!isset($_GET['id']) || empty($_GET['id'])) && (!isset($_POST['id']) || empty($_POST['id']))) {
				showmessage('非法操作！','index.php?m='.ROUTE_M.'&c='.ROUTE_C.'&a=init&path='.$this->path.'&pc_hash='.$_GET['pc_hash']);
			} else {
				if(is_array($_POST['id'])){
					foreach($_POST['id'] as $id) {
						$this->apply_db->delete(array('id'=>$id));
					}
				showmessage('操作成功！','index.php?m='.ROUTE_M.'&c='.ROUTE_C.'&a=init&path='.$this->path.'&pc_hash='.$_GET['pc_hash']);
				}else{
					$id = intval($_GET['id']);
					if($id < 1) return false;
					$this->apply_db->delete(array('id'=>$id));
					showmessage('操作成功！','index.php?m='.ROUTE_M.'&c='.ROUTE_C.'&a=init&path='.$this->path.'&pc_hash='.$_GET['pc_hash']);
				}
			}
		}
	}
	/*---------------------------------------楼盘列表-------------------------------------------------------------------*/
	// 搜索功能
	function players(){
		$where = $orderby = $condition = '';
		if((isset($_GET['starttime']) && !empty($_GET['starttime']))){
			$starttime = strtotime($_GET['starttime']);
			$where .= ($where ? ' AND ' : '').'`dateline` > '.$starttime;
            $condition .= ($condition ? '+' : '').$_GET['starttime'];
		}
		if (isset($_GET['endtime']) && !empty($_GET['endtime'])){
			$endtime = strtotime($_GET['endtime']) + 86400;
			$where .= ($where ? ' AND ' : '').'`dateline` < '.$endtime;
            $condition .= ($condition ? '+' : '').$_GET['endtime'];
		}
		// 关键字
		if (isset($_GET['keyword1']) && !empty($_GET['keyword1'])){
			$keyword1 = $_GET['keyword1'];
            $keyword1 = safe_replace($keyword1);
			$keyword1 = htmlspecialchars(strip_tags($keyword1), ENT_COMPAT, 'GB2312');
			$where .= ($where ? ' AND ' : '')."`title` LIKE '%$keyword1%' OR `bulidname` LIKE '%$keyword1%'";
            $condition .= ($condition ? '+' : '').$keyword1;
		}
		// 装饰公司关键字
		if (isset($_GET['keyword2']) && !empty($_GET['keyword2'])) {
			$keyword2 = intval($_GET['keyword2']);
			$where .= ($where ? ' AND ' : '')."`constrpart` LIKE '%$keyword2%'";
			$condition .= ($condition ? '+' : '').$keyword2;
		}
		
		$page = max(1,intval($_GET['page']));
		$infos = $this->players_db->listinfo($where,'`id` DESC',$page,20);
		$counts = $this->players_db->count($where);
		$pages = $this->players_db->pages;
		include $this->admin_tpl('index');
	}
	/*---------------------------------------------------增加楼盘列表---------------------------------------------------------------*/
	function players_add(){
		$id = intval($_GET['id']);
		if(isset($_POST['dosubmit']) && !empty($_POST['dosubmit'])){

			// 要过滤的字段
			$filter_array = array('title','bulidname','housestyle','constrpart','material');
			foreach($filter_array as $val){
				$_POST['info'][$val] = new_html_entity_decode(strip_tags(trim($_POST['info'][$val])));
			}
			if(!isset($_POST['info']['confirm'])){
				$_POST['info']['confirm'] = 0;
			}

			if($id){
				$this->players_db->update($_POST['info'],'`id` = '.$id);
			}else{
				$_POST['info']['dateline'] = SYS_TIME;
				$this->players_db->insert($_POST['info']);
			}
			showmessage('操作成功','index.php?m='.ROUTE_M.'&c='.ROUTE_C.'&a=players&path='.$this->path.'&pc_hash='.$_GET['pc_hash']);
			
		}else{
			if($id){
				$info = $this->players_db->get_one('`id` = '.$id);
			}
			include $this->admin_tpl('index');
		}
	}

	function pic_add(){
		$id = intval($_GET['id']);

		if(isset($_POST['dosubmit']) && !empty($_POST['dosubmit'])){

			function arrfilter($a){
				return ($a != '' && $a != ' ');
			}
			$_POST['img'] = array_filter($_POST['img'], 'arrfilter');
			$_POST['img'] = implode('|', $_POST['img']);

			// var_dump($_POST);exit();
			// $_POST['img'] = $_POST['img'][0];
			
			$rs = $this->players_db->update("`img` ='".$_POST['img']."', `thumb` ='".$_POST['thumb']."'", "`id` ='".$id."'");
			if($rs){
				showmessage('操作成功！', 'index.php?m='.ROUTE_M.'&c='.ROUTE_C.'&a=players&path='.$this->path.'&pc_hash='.$_GET['pc_hash']);
			}
		}

		if($id){
			$info = $this->players_db->get_one('`id` = '.$id);
			$info['img'] = explode('|', $info['img']);
			// var_dump($info['img']);
			
		}

		include $this->admin_tpl('index');
	}
	
	/*---------------------------------------------------删除楼盘列表---------------------------------------------------------------*/
	function players_delete(){
		if (isset($_POST['dodelete']) && !empty($_POST['dodelete']) || $_GET['id']){
			if((!isset($_GET['id']) || empty($_GET['id'])) && (!isset($_POST['id']) || empty($_POST['id']))) {
				showmessage('非法操作！','index.php?m='.ROUTE_M.'&c='.ROUTE_C.'&a=players&path='.$this->path.'&pc_hash='.$_GET['pc_hash']);
			} else {
				if(is_array($_POST['id'])){
					foreach($_POST['id'] as $id) {
						$this->players_db->delete(array('id'=>$id));
					}
					showmessage('操作成功！','index.php?m='.ROUTE_M.'&c='.ROUTE_C.'&a=players&path='.$this->path.'&pc_hash='.$_GET['pc_hash']);
				}else{
					$id = intval($_GET['id']);
					if($id < 1) return false;
					$this->players_db->delete(array('id'=>$id));
					showmessage('操作成功！','index.php?m='.ROUTE_M.'&c='.ROUTE_C.'&a=players&path='.$this->path.'&pc_hash='.$_GET['pc_hash']);
				}
			}
		}
	}
	/*-------------------------------------------------更改认证状态-----------------------------------------------------------*/
	function players_confirm(){
		$id = intval($_GET['id']);
		$info = $this->players_db->get_one(array('id'=>$id));
		if (!empty($info)){
			$confirm = $info['confirm'] ? 0 : 1;
			$this->players_db->update(array('confirm'=>$confirm), array('id'=>$id));
			showmessage('操作成功', $_GET['return_url']);
		}else {
			showmessage('操作失败',$_GET['return_url']);
		}
	}

	function part_info(){
		$infos = getcache('201506_house_shops','commons');
		include $this->admin_tpl('index');
	}

	function part_modify(){
		$id = intval($_GET['id']);
		$infos = getcache('201506_house_shops','commons');
		if(isset($_POST['dosubmit']) && !empty($_POST['dosubmit'])){

			// $infos[$id]['name'] = $_POST['info']['name'];
			$data['craftwork'] = str_replace("\\", "", $_POST['info']['craftwork']);
			$data['basematerial'] = str_replace("\\", "", $_POST['info']['basematerial']);
			$data['service'] = str_replace("\\", "", $_POST['info']['service']);
			$infos[$id]['detail'] = array('craftwork'=>$data['craftwork'],'basematerial'=>$data['basematerial'],'service'=>$data['service']);
			// var_dump($infos);exit();
			setcache('201506_house_shops',$infos,'commons');

			showmessage('操作成功','index.php?m='.ROUTE_M.'&c='.ROUTE_C.'&a=part_info&path='.$this->path.'&pc_hash='.$_GET['pc_hash']);
			
		}else{
			if($id){
				$info = $infos[$id]['detail'];

			}
			include $this->admin_tpl('index');
		}
	}
}

	
?>