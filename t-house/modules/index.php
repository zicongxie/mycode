<?php  
defined('IN_PHPCMS') or exit('No permission resources.');
!IS_ZT && defined('IS_ZT', TRUE);
ini_set("memory_limit", " 100M");
pc_base::load_sys_func('iconv');

class index{

	function __construct(){
		$this->apply_db = pc_base::load_model('apply_model');
        $this->players_db = pc_base::load_model('players_model');
        $this->thumb_db = pc_base::load_model('thumb_model');
		header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
	}

	function init(){
		$page_title = '西子家居－样板房装修争霸赛';
		$keyword = '西子家居－样板房装修争霸赛';
		$description = '西子家居－样板房装修争霸赛';

		$infos1 = $this->players_db->select("`constrpart`= '1' AND `confirm` = '1'", '*', 3, 'readnum DESC');
		$infos2 = $this->players_db->select("`constrpart`= '2' AND `confirm` = '1'", '*', 3, 'readnum DESC');
		$infos3 = $this->players_db->select("`constrpart`= '3' AND `confirm` = '1'", '*', 3, 'readnum DESC');
		$infos4 = $this->players_db->select("`constrpart`= '4' AND `confirm` = '1'", '*', 3, 'readnum DESC');
		$infos5 = $this->players_db->select("`constrpart`= '5' AND `confirm` = '1'", '*', 3, 'readnum DESC');

		$signCount = $this->apply_db->count("`flag` = 1");
		$orderCount = $this->apply_db->count("`flag` = 2");
		
		$read = file_get_contents('http://testhome.xizi.com/index.php?m=company&c=api&a=getCaseNum&ids=15,119,120,121');
		$read = json_decode(trim($read,'(,)'), true);
		$readnum = $read['data'];

		include xz_template('index');
	}
	
	// function sign(){
	// 	$page_title = '西子家居－样板房装修争霸赛';
	// 	$keyword = '西子家居－样板房装修争霸赛';
	// 	$description = '西子家居－样板房装修争霸赛';
	// 	$phonepreg = '/^[13|15|18]\d+$/is';
	// 	if(isset($_POST['sub']) && !empty($_POST['sub'])){
	// 		if(strlen($_POST['info']['name']) > 12 || strlen($_POST['info']['name']) <= 2){
	// 			showmessage('输入的姓名太短，请输入正确为的姓名',HTTP_REFERER);
	// 		}
	// 		$_POST['info']['name'] = htmlspecialchars(trim($_POST['info']['name']));//检测输入名字是否合法
	// 		if(!is_numeric($_POST['info']['phone'])){
	// 			showmessage('输入的手机号码有误，请重新输入',HTTP_REFERER);
	// 		}
	// 		$checkphone = preg_match($phonepreg,$_POST['info']['phone']);
	// 		if(!$checkphone){
	// 			showmessage('输入的手机号码不对，请输入正确的手机号码',HTTP_REFERER);//检测输入手机是否合法
	// 		}
	// 		$_POST['info']['areaname'] = htmlspecialchars(strip_tags(trim($_POST['info']['areaname'])));
	// 		if(!intval($_POST['info']['usearea'])){
	// 			showmessage('输入的面积不对，请重新输入',HTTP_REFERER);//检测输入面积是否合法
	// 		}
	// 		$exists = $this->apply_db->get_one("`phone` = '".$_POST['info']['phone']."'");
	// 		if($exists){
	// 			showmessage('该用户已经注册,请直接登录',HTTP_REFERER);
	// 		}else{
	// 			$return = $this->apply_db->insert($_POST['info']);
	// 			if($return){
	// 				showmessage('注册成功',HTTP_REFERER);
	// 			}else{
	// 				showmessage('注册失败',HTTP_REFERER);
	// 			}
	// 		}	
	// 	}else{
	// 		showmessage('非法操作',HTTP_REFERER);
	// 	}
	// 	//include xz_template('index');
	// }
	
	function detail(){
		$page_title = '西子家居－样板房装修争霸赛';
		$keyword = '西子家居－样板房装修争霸赛';
		$description = '西子家居－样板房装修争霸赛';

		$id = intval($_GET['id']);
		$info = $this->players_db->get_one("`id` ='".$id."'");
		$info['img'] = explode('|', $info['img']);
		$readcount = $this->players_db->select("`constrpart` ='".$info['constrpart']."'", 'SUM(`readnum`) AS readcount');
		$pid = $info['constrpart'];
		// $readcount = array_sum(array_column($readcount, 'readnum'));
		$part = getcache('201506_house_shops','commons');

		$shopsDetail = $part[$pid]['detail'];

		$signCount = $this->apply_db->count("`flag` = 1");
		$orderCount = $this->apply_db->count("`flag` = 2");

		$count = count($info['img']);
		$this->players_db->update(array('readnum'=>'+=1'), "`id` ='".$id."'");
		include xz_template('detail');
	}
	
	function piclist(){
		$page_title = '西子家居－样板房装修争霸赛';
		$keyword = '西子家居－样板房装修争霸赛';
		$description = '西子家居－样板房装修争霸赛';
		$page = max(1,intval($_GET['page']));
		$page_size = 10;
		$infos = $this->players_db->listinfo('','id DESC',$page,$page_size);
		$pages = $this->players_db->pages;

		$signCount = $this->apply_db->count("`flag` = 1");

		$read = file_get_contents('http://testhome.xizi.com/index.php?m=company&c=api&a=getCaseNum&ids=15,119,120,121');
		$read = json_decode(trim($read,'(,)'), true);
		$readnum = $read['data'];

		include xz_template('list');
	}

	function intro(){
		$page_title = '西子家居－样板房装修争霸赛';
		$keyword = '西子家居－样板房装修争霸赛';
		$description = '西子家居－样板房装修争霸赛';

		include xz_template('intro');
	}

	/**
     * ajax用户报名
     *
     */
	public function ajax_sign(){

		$name =  empty($_POST['info']['name']) ? '' : new_addslashes(trim($_POST['info']['name']));
		$name = iconv('utf-8', 'gbk', $name);
		$phone = empty($_POST['info']['phone']) ? '' : new_addslashes(trim($_POST['info']['phone']));
		$areaname = empty($_POST['info']['areaname']) ? '' :new_addslashes(trim($_POST['info']['areaname']));
		$areaname = iconv('utf-8', 'gbk', $areaname);
		$usearea = empty($_POST['info']['usearea']) ? '' : new_addslashes(trim($_POST['info']['usearea']));
		$dateline = SYS_TIME;
		$flag = 1;
		if($_GET['i'] == 1){
			$source = "首页－报名参赛";
		}elseif($_GET['i'] == 2){
			$source = "列表页－报名参赛";
		}elseif($_GET['i'] == 3){
			$source = "详情页－报名参赛";
		}

		if($name == '' || $phone == '' || $areaname == '' || $usearea == ''){
            $return_arr = array('error'=>-1,'msg'=>'用户名或电话或小区名称或面积大小不能为空');
        }else{
            $res = $this->apply_db->insert(array('name'=>$name, 'phone'=>$phone, 'areaname'=>$areaname, 'usearea'=>$usearea, 'dateline'=>$dateline, 'source'=>$source, 'flag'=>$flag));
            if($res){
                $return_arr = array('error'=>0,'msg'=>'添加成功!');
            }else{
                $return_arr = array('error'=>-2,'msg'=>'添加失败!');
            }
        }
        $return_arr = array_iconv($return_arr);
        echo json_encode($return_arr);
	}

	/**
     * ajax用户预约
     *
     */
	public function ajax_order(){
		$name = empty($_POST['info']['name']) ? '' : new_addslashes(trim($_POST['info']['name']));
		$name = iconv('utf-8', 'gbk', $name);
		$phone = empty($_POST['info']['phone']) ? '' : new_addslashes(trim($_POST['info']['phone']));
		$date = empty($_POST['info']['date']) ? '' : new_addslashes(trim($_POST['info']['date']));
		$date = strtotime($date);
		$dateline = SYS_TIME;
		$flag = 2;
		if($_GET['k'] == 1){
			$source = "详情页－预约参观";
		}
		if($_GET['k'] == 2){
			$source = "首页－预约参观";
		}
		
		if(isset($_GET['x']) && isset($_GET['y'])){
			
			switch ($_GET['x']) {
				case '1':
					$_GET['x'] = "蜗居装饰";
					break;
				case '2':
					$_GET['x'] = "易百装饰";
					break;
				case '3':
					$_GET['x'] = "华宁装饰";
					break;
				case '4':
					$_GET['x'] = "三星装饰";
					break;
				case '5':
					$_GET['x'] = "皇城装饰";
					break;
			}

			$x = "-".$_GET['x'];
			$y = "-".$_GET['y'];
			$source = $source.$x.$y;

		}elseif (isset($_POST['id'])) {

			$this->players_db->update(array('order'=>'+=1'), "`id` ='".$_POST['id']."'");
			$in = $this->players_db->get_one("`id` ='".$_POST['id']."'", '`constrpart`, `title`');

			switch ($in['constrpart']) {
				case '1':
					$in['constrpart'] = "蜗居装饰";
					break;
				case '2':
					$in['constrpart'] = "易百装饰";
					break;
				case '3':
					$in['constrpart'] = "华宁装饰";
					break;
				case '4':
					$in['constrpart'] = "三星装饰";
					break;
				case '5':
					$in['constrpart'] = "皇城装饰";
					break;
			}
			$x = "-".$in['constrpart'];
			$y = "-".$in['title'];
			$source = $source.$x.$y;
			
		}

		if($name == '' || $phone == '' || $date == ''){
            $return_arr = array('error'=>-1,'msg'=>'用户名、电话和日期不能为空');
        }else{
            $res = $this->apply_db->insert(array('name'=>$name, 'phone'=>$phone, 'date'=>$date, 'dateline'=>$dateline, 'date'=>$date, 'source'=>$source, 'flag'=>$flag));
            if($res){
                $return_arr = array('error'=>1,'msg'=>'预约成功!');
            }else{
                $return_arr = array('error'=>-3,'msg'=>'预约失败!');
            }
        }
        $return_arr = array_iconv($return_arr);
        echo json_encode($return_arr);
	}
}

?>