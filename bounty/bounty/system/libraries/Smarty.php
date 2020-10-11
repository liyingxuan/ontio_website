<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require(BASEPATH . 'libraries/Smarty/Smarty.class.php');
//CI，文件系统全用相对路径相对index.php所在的路径，url全部用绝对路径。
//BASEPATH    - The full server path to the "system" folder
//APPPATH    - The full server path to the "application" folder
class CI_Smarty extends Smarty
{
  
  public function __construct()
  {  
    parent::__construct();
    $this->caching = true;//开启缓存
	$this->force_compile = true; //强迫编译
	$this->cache_lifetime = 120;  //缓存存活时间（秒）
	$this->left_delimiter = '<{';
	$this->right_delimiter = '}>';
    $this->setTemplateDir(APPPATH . 'views'); //设定所有模板文件都需要放置的目录地址。
    $this->setConfigDir(APPPATH . 'views/configs'); //设定用于存放模板特殊配置文件的目录，
    $this->setCacheDir(ROOTPATH . 'cache/cache'); //在启动缓存特性的情况下，这个属性所指定的目录中放置Smarty缓存的所有模板
    $this->setPluginsDir(APPPATH . 'views/plugins'); //插件目录
    $this->setCompileDir(ROOTPATH. 'cache/templates_c'); //设定Smarty编译过的所有模板文件的存放目录地址
    
 
  }
 
}
 
?>