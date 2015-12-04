<?php
/**
 * 	敏感词处理类
 *
 * 	DEMO：
 *  use App\Helper\SensitiveHandle;
 *  $text = '敏感词 有没搞错';
 *  $model = new SensitiveHandle();
 *  $code = $model->check($text);	检查敏感词方法 返回整型 0：没有敏感词 1：有替换敏感词 -1：有禁用敏感词 false:参数没传
 * 	$model->getReplace()   		获取匹配到的替换敏感词词组 PS：此方法要先执行检查敏感词方法
 *  $model->getSensitive()  	获取匹配到的禁用敏感词词组 PS：此方法要先执行检查敏感词方法
 *	$model->replace('**')		敏感词替换,返回替换后的字符串
 *  $model->saveContent($type,$content_id,$author_uid)  插入敏感词内容 
 */
namespace App\Helper;

use Storage;
use League\Flysystem\Filesystem;
use App\Model\SensitiveWords;
use App\Model\SensitiveContent;
use App\Helper\SimpleDict;

class SensitiveHandle
{
	
	public $sensitive,$replace,$content;
	
	public function __construct($content='') {
		$this->content = $content;
		$ext = Storage::exists('dict/replace.dict');
		if(!$ext){
			$this->upDict();
		}	
    }
	
	/*
	 *敏感词字典更新
	 *@return  string    
	 */
	public static function upDict()
	{
		$stop =SensitiveWords::where('type','=',1)->get()->toArray();
		$replace = SensitiveWords::where('type','=',2)->get()->toArray();
		if(!empty($stop))
		{
			$stop_arr = array();
			foreach($stop as $k=>$v)
			{
				$stop_arr[] = array('title'=>$v['words'],'id'=>$v['id']);
			}
			$stop_dict = storage_path('app'.DIRECTORY_SEPARATOR.'dict'.DIRECTORY_SEPARATOR.'sensitive.dict');
			$ext = Storage::exists('dict/sensitive.dict');
			if(!$ext)
				Storage::put('dict/sensitive.dict','');
			SimpleDict::makeFromArray($stop_arr,$stop_dict);
		}
		if(!empty($replace))
		{
			$replace_arr = array();
			foreach($replace as $k=>$v)
			{
				$replace_arr[] = array('title'=>$v['words'],'id'=>$v['id']);
			}
			$stop_dict = storage_path('app'.DIRECTORY_SEPARATOR.'dict'.DIRECTORY_SEPARATOR.'replace.dict');
			$ext = Storage::exists('dict/replace.dict');
			if(!$ext)
				Storage::put('dict/replace.dict','');
			SimpleDict::makeFromArray($replace_arr,$stop_dict);
		}
		return TRUE;
	}
		
	/*
	 *敏感词替换
	 *@params $rep_text string 替换敏感词的符号
	 *@return  string    
	 */
	public function replace($rep_text = '**')
	{
		$content = $this->content;
		$replace = new SimpleDict('replace');
		$r_result = $replace->search($this->content);
		if(!empty($r_result))
		{
			$content = $replace->replace($this->content,$rep_text);
		}
		return $content;
	}
	
	/*
	 *敏感词检查
	 *@return  int|bool  
	 */
	public function check($content = '')
	{
		if($content)
			$this->content = $content;
		
		if(empty($this->content))
			return false;
		
		$code = 0;
		$replace = new SimpleDict('replace');
		$r_result = $replace->search($this->content);
		if(!empty($r_result))
		{
			$this->replace = $r_result;
			$code = 1;
		}
		//敏感词
		$sensitive = new SimpleDict('sensitive');
		$s_result = $sensitive->search($this->content);
		if(!empty($s_result))
		{
			$this->sensitive = $s_result;
			$code = -1;
		}
		return $code;
	}
	
	/*
	 *插入敏感词内容
	 *$params	$type  		int	类型(1=>回复,2=>主题,3=>活动)
	 *$params   $content_id	int	内容ID 
	 *$params	$author_uid	int 发布人ID
	 *$params	$admin_uid 	int	用户ID
	 *@return  bool|obj    
	 */
	public function saveContent($type,$content_id,$author_uid)
	{
		if(!$type OR !$content_id OR !$author_uid)
			return FALSE;
		$type = (int)$type;
		$content_id = (int)$content_id;
		$author_uid = (int)$author_uid;
		$arr = array();
		if(!empty($this->sensitive))
		{
			foreach($this->sensitive as $key=>$value)
			{
				$arr[] = $key;
			}
		}
		if(!empty($this->replace))
		{
			foreach($this->replace as $key=>$value)
			{
				$arr[] = $key;
			}
		}
		$words = implode('|',$arr);
		$rel = SensitiveContent::create([
			'content_id'=>$content_id,
			'author_uid'=>$author_uid,
			'words'	=>  $words,
			'type'=>$type,
			]);
		return $rel;
	}	
	
	/*
	 *获取禁用敏感词
	 *@return  array|null
	 */
	public function getSensitive()
	{
		return $this->sensitive;
	}
	
	/*
	 *获取替换敏感词
	 *@return  array|null    
	 */
	public function getReplace()
	{
		return $this->replace;
	}
}