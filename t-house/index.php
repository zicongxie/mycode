<?php
define('ZT_PATH', dirname(__FILE__).DIRECTORY_SEPARATOR);

$script_name_array = explode('/', $_SERVER['SCRIPT_NAME']);
define('ZT_STATIC', $script_name_array[2].'/'.$script_name_array[3].'/'.$script_name_array[4]);


include '../../../phpcms/base.php';
include '../../../uc_client/config.php';
include '../../../uc_client/client.php';

//define('ZT_CSS', APP_PATH.ZT_STATIC.'/statics/css/');
//define('ZT_JS',  APP_PATH.ZT_STATIC.'/statics/js/');
define('ZT_CSS','statics/css/');
define('ZT_JS','statics/js/');
define('ZT_IMAGES', APP_PATH.ZT_STATIC.'/statics/images/');

$XzSynUser = pc_base::load_sys_class('XzSynUser');
list($xizi_uid, $xizi_username) = $XzSynUser->getXzUser();

$xizi_uid = $xizi_username = 67716;

//修复西子用户同步问题 yqh 2014-11-11

define('XIZI_UID', $xizi_uid);
define('XIZI_USERNAME',$xizi_username);
if(strpos(APP_PATH,'xizi.com') !== FALSE){
    define('LOGIN_SITE','http://my.xizi.com');
    define('LOGIN_URL','http://my.xizi.com/index.php?r=members/login');
    define('LOGOUT_URL','http://my.xizi.com/index.php?r=members/logout');
    define('REGISTER_URL','http://my.xizi.com/index.php?r=members/phoneregister');
}else{//local
    define('LOGIN_SITE','http://192.168.0.102/my');
    define('LOGIN_URL','http://192.168.0.102/my/login');
    define('LOGOUT_URL','http://192.168.0.102/my/logout');
    define('REGISTER_URL','http://192.168.0.102/my/register');
}
pc_base::creat_app();
?>
