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
		$page_title = '���ӼҾӣ����巿װ��������';
		$keyword = '���ӼҾӣ����巿װ��������';
		$description = '���ӼҾӣ����巿װ��������';

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
	// 	$page_title = '���ӼҾӣ����巿װ��������';
	// 	$keyword = '���ӼҾӣ����巿װ��������';
	// 	$description = '���ӼҾӣ����巿װ��������';
	// 	$phonepreg = '/^[13|15|18]\d+$/is';
	// 	if(isset($_POST['sub']) && !empty($_POST['sub'])){
	// 		if(strlen($_POST['info']['name']) > 12 || strlen($_POST['info']['name']) <= 2){
	// 			showmessage('���������̫�̣���������ȷΪ������',HTTP_REFERER);
	// 		}
	// 		$_POST['info']['name'] = htmlspecialchars(trim($_POST['info']['name']));//������������Ƿ�Ϸ�
	// 		if(!is_numeric($_POST['info']['phone'])){
	// 			showmessage('������ֻ�������������������',HTTP_REFERER);
	// 		}
	// 		$checkphone = preg_match($phonepreg,$_POST['info']['phone']);
	// 		if(!$checkphone){
	// 			showmessage('������ֻ����벻�ԣ���������ȷ���ֻ�����',HTTP_REFERER);//��������ֻ��Ƿ�Ϸ�
	// 		}
	// 		$_POST['info']['areaname'] = htmlspecialchars(strip_tags(trim($_POST['info']['areaname'])));
	// 		if(!intval($_POST['info']['usearea'])){
	// 			showmessage('�����������ԣ�����������',HTTP_REFERER);//�����������Ƿ�Ϸ�
	// 		}
	// 		$exists = $this->apply_db->get_one("`phone` = '".$_POST['info']['phone']."'");
	// 		if($exists){
	// 			showmessage('���û��Ѿ�ע��,��ֱ�ӵ�¼',HTTP_REFERER);
	// 		}else{
	// 			$return = $this->apply_db->insert($_POST['info']);
	// 			if($return){
	// 				showmessage('ע��ɹ�',HTTP_REFERER);
	// 			}else{
	// 				showmessage('ע��ʧ��',HTTP_REFERER);
	// 			}
	// 		}	
	// 	}else{
	// 		showmessage('�Ƿ�����',HTTP_REFERER);
	// 	}
	// 	//include xz_template('index');
	// }
	
	function detail(){
		$page_title = '���ӼҾӣ����巿װ��������';
		$keyword = '���ӼҾӣ����巿װ��������';
		$description = '���ӼҾӣ����巿װ��������';

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
		$page_title = '���ӼҾӣ����巿װ��������';
		$keyword = '���ӼҾӣ����巿װ��������';
		$description = '���ӼҾӣ����巿װ��������';
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
		$page_title = '���ӼҾӣ����巿װ��������';
		$keyword = '���ӼҾӣ����巿װ��������';
		$description = '���ӼҾӣ����巿װ��������';

		include xz_template('intro');
	}

	/**
     * ajax�û�����
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
			$source = "��ҳ����������";
		}elseif($_GET['i'] == 2){
			$source = "�б�ҳ����������";
		}elseif($_GET['i'] == 3){
			$source = "����ҳ����������";
		}

		if($name == '' || $phone == '' || $areaname == '' || $usearea == ''){
            $return_arr = array('error'=>-1,'msg'=>'�û�����绰��С�����ƻ������С����Ϊ��');
        }else{
            $res = $this->apply_db->insert(array('name'=>$name, 'phone'=>$phone, 'areaname'=>$areaname, 'usearea'=>$usearea, 'dateline'=>$dateline, 'source'=>$source, 'flag'=>$flag));
            if($res){
                $return_arr = array('error'=>0,'msg'=>'��ӳɹ�!');
            }else{
                $return_arr = array('error'=>-2,'msg'=>'���ʧ��!');
            }
        }
        $return_arr = array_iconv($return_arr);
        echo json_encode($return_arr);
	}

	/**
     * ajax�û�ԤԼ
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
			$source = "����ҳ��ԤԼ�ι�";
		}
		if($_GET['k'] == 2){
			$source = "��ҳ��ԤԼ�ι�";
		}
		
		if(isset($_GET['x']) && isset($_GET['y'])){
			
			switch ($_GET['x']) {
				case '1':
					$_GET['x'] = "�Ͼ�װ��";
					break;
				case '2':
					$_GET['x'] = "�װ�װ��";
					break;
				case '3':
					$_GET['x'] = "����װ��";
					break;
				case '4':
					$_GET['x'] = "����װ��";
					break;
				case '5':
					$_GET['x'] = "�ʳ�װ��";
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
					$in['constrpart'] = "�Ͼ�װ��";
					break;
				case '2':
					$in['constrpart'] = "�װ�װ��";
					break;
				case '3':
					$in['constrpart'] = "����װ��";
					break;
				case '4':
					$in['constrpart'] = "����װ��";
					break;
				case '5':
					$in['constrpart'] = "�ʳ�װ��";
					break;
			}
			$x = "-".$in['constrpart'];
			$y = "-".$in['title'];
			$source = $source.$x.$y;
			
		}

		if($name == '' || $phone == '' || $date == ''){
            $return_arr = array('error'=>-1,'msg'=>'�û������绰�����ڲ���Ϊ��');
        }else{
            $res = $this->apply_db->insert(array('name'=>$name, 'phone'=>$phone, 'date'=>$date, 'dateline'=>$dateline, 'date'=>$date, 'source'=>$source, 'flag'=>$flag));
            if($res){
                $return_arr = array('error'=>1,'msg'=>'ԤԼ�ɹ�!');
            }else{
                $return_arr = array('error'=>-3,'msg'=>'ԤԼʧ��!');
            }
        }
        $return_arr = array_iconv($return_arr);
        echo json_encode($return_arr);
	}
}

?>