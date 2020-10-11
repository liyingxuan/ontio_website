<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
	/**
	 * Index Page for this controller.
	 */
    public function __construct() {
        parent::__construct();
        $this->load->helper('cookie');//添加cookie助手函数 
    }
	public function index(){    
	   $this->load->model('System');
	   $siteinfo=$this->System->getSystemValue(array('website_name','icp_number','website_keywords','service_tel','service_qq','website_desc'));
	   $this->smarty->assign('siteinfo',$siteinfo['data']);
	   $this->smarty->display('default.html');

	} 
}
