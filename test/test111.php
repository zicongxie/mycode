<?php 
	$header_link = array(
        array('url'=>'www.baidu.com','text'=>'文惠网'),
        'end'=>array('url'=>'?m=content&c=index&a=privilege','text'=>'惠民信息'),
    );
    var_dump($header_link);

    foreach ($header_link as $k => $v) {
        echo $k;
        if ((string) $k != 'end') {
            echo ">";
        }
    }

 ?>