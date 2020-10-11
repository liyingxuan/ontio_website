<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Index extends CI_Controller {
	/**
	 * Index Page for this controller.
	 */
    public function __construct() {
        parent::__construct();
        $this->load->Model('System');
	}
	/*悬浮框架基础页*/
    public function index(){
	   if ((!isset($_SESSION['admin_id']) || intval($_SESSION['admin_id']) <= 0))
       {
           header("location:".base_url("admin.php/index/login"));
           exit();
       }
        $this->load->model('system');
        $sitename=$this->system->getSystemValue('website_name');
	    $tree=$this->system->getActionList();
	    $menuTree=$tree['data'];
	    if($_SESSION['admin_is_super']!=1)
	    {
	    	 foreach ($menuTree  as $key => $row ) {
	    		$res=$this->system->isPriv($row['role'],false);
	    		if(!$res['state'])
	    		{
	    			 unset($row[$key]);
	    		}
	    		if(isset($row['list'] ))
	    	    {
		    		foreach($row['list'] as $ke=>$ro)
		    		{
		    			$res=$this->system->isPriv($row['role'],false);
			    		if(!$res['state'])
			    		{
			    			 unset($row[$key]);
			    		}
			    		if(isset($row['list'] ))
			    	    {
				    		foreach($row['list'] as $ke=>$ro)
				    		{
				    			$res=$this->system->isPriv($row['role'],false);
					    		if(!$res['state'])
					    		{
					    			 unset($row[$key]);
					    		}
				    		}
			    		
			    	    }
		    		}
	    		
	    	    }       
	      }
	    }
	    $this->smarty->assign('user_name',$_SESSION['admin_name']);
	    $this->smarty->assign('role_name',$_SESSION['admin_role_name']);  
	    $this->smarty->assign('menu_data', $tree['data']);
	    $this->smarty->assign('sitename',$sitename['data']['website_name']);
	    $this->smarty->display('iframe.html');
	}

    public function home(){
    	$this->load->model('Admin');
		$res = $this->Admin->getAdminLog('1=1', 'log_time', 'desc', 1, 3);
		foreach ($res['data']['datas'] as $key => $row) {
			$res['data']['datas'][$key]['log_time'] = empty($row['log_time']) ? '-' : date('Y-m-d H:i:s', $row['log_time']);
		}
		$this->smarty->assign('logdata', $res['data']['datas']);
	    $this->smarty->display('home.html');
	}
	public function login(){
		if($_POST)
		{
	        $username = isset($_POST['user']) ? trim($_POST['user']) : '';
	        $password = isset($_POST['pwd']) ? trim($_POST['pwd']) : '';
	        $this->load->Model('Admin');
	        $res = $this->Admin->adminLogin($username, sha1($password));
	        if ($res['state']) {
	            if (empty($res['data'])) {
	                echo json_encode(array('state' => false, 'msg' => '用户名或密码错误'));die;
	            }
	
	            if ($res['data']['admin_is_super'] != '1') {
	                $roleRes = $this->Admin->getAdminPri(intval($res['data']['role_id'])); //获取角色
	                if (!$roleRes['state']) {
	                    echo json_encode(array('state' => false, 'msg' => $roleRes['msg']));die;
	                }
	                $res['data']['action_list'] = $roleRes['data']['role_actions'];
	                $res['data']['admin_role_name'] = $roleRes['data']['role_name'];
	            } else {
	                $res['data']['action_list'] = 'all';
	                $res['data']['admin_role_name'] = '超级管理';
	            }
	            //更新登录信息 最后登录时间 登录ip 登录次数
	            $data = array();
	            $admin_login_time = time();
	            $admin_last_ip = real_ip();
	            $admin_login_num = isset($res['data']['admin_login_num']) ? intval($res['data']['admin_login_num']) + 1 : 0;
	            
	            $data = array(
	                'admin_login_time' => $admin_login_time,
	                'admin_last_ip' => $admin_last_ip,
	                'admin_login_num' => $admin_login_num,
	            );
	            $admin_id = $res['data']['admin_id'];
	            $admin_name = $res['data']['admin_name'];
	            $where = "admin_id = $admin_id";
	            $this->Admin->updateAdmin($data, $where);
	            //记录日志
	            $admin_name = $res['data']['admin_name'];
	            $this->session->set_userdata($res['data']);
	            $this->System->logAction('用户' . $admin_name . '登录', __METHOD__);
	            echo json_encode(array('state' => true, 'msg' => '登录成功'));
	        } else {
	            echo json_encode(array('state' => false, 'msg' => $res['msg']));
	        }
		}else{
		   $this->load->model('System');
		   $icp=$this->System->getSystemValue('icp_number');
		   $this->smarty->assign('icp',$icp['data']['icp_number']);
		   $sitename=$this->System->getSystemValue('website_name');
		   $this->smarty->assign('sitename',$sitename['data']['website_name']);
		   $recorded = isset($_SESSION['yzcode']) ? ($_SESSION['yzcode']) : '';
		   $this->smarty->assign('random',$recorded);
		   $this->smarty->display('login.html');  
		}   
	}
		/*验证码验证*/
	public function check_captcha(){
		
	    $captcha = isset($_POST['captcha']) ? trim($_POST['captcha']) : '';
	    $recorded = isset($_SESSION['yzcode']) ? ($_SESSION['yzcode']) : '';
	    if(strcasecmp($recorded,$captcha)!=0){
	        $data = array('state'=>false,'msg'=>'验证码错误');
	    }else{
	        $data = array('state'=>true,'msg'=>'验证码输入正确');
	    }
	    
	    echo  json_encode($data);die;
	}
	/**
	 * 账户信息
	 * @author:  雷鼎
	 */
	public function change_pwd(){
		if($_POST){
			//判断密码有效性
			$oldpwd=isset($_POST['old_password'])?trim($_POST['old_password']):'';
			$newpwd=isset($_POST['new_password'])?trim($_POST['new_password']):'';
			if(isset($_SESSION) && !empty($_SESSION['admin_id'])){
				//获取管理员id
				$admin_id=$_SESSION['admin_id'];
				$where="admin_id = '{$admin_id}'";
				$res=$this->System->checkoldPwd($where);
				//判断旧密码是否与数据库匹配
				if(sha1($oldpwd) !== $res['data']['admin_pwd']){
					echo exit(json_encode(array('state'=>false,'msg'=>'旧密码输入错误','data'=>'')));
				}
				//旧密码不能与新密码相同
				if($oldpwd == $newpwd){
					echo exit(json_encode(array('state'=>false,'msg'=>'新密码与旧密码不能相同','data'=>'')));
				}

				$res1=$this->System->changePwd(array('admin_pwd'=>sha1($newpwd)),array('admin_id'=>$admin_id));
				if(!$res1['state']){
					echo exit(json_encode(array('state'=>false,'msg'=>'密码修改失败','data'=>'')));
				}else{
					session_unset();
					$this->session->sess_destroy();
					//密码修改成功后退出登录,同时销毁session
					echo exit(json_encode(array('state'=>true,'msg'=>'修改成功','data'=>'')));
				}
			}
		}else{
			$this->smarty->display('changepwd.html');
		}
	}


	public function login_out(){
		/* 清除session */
		session_unset();
		$this->session->sess_destroy();
		header("location:".base_url("admin.php/index/login"));
	}
	/* 生成验证码*/
	public function verify_image(){
	    $this->load->library('captcha');
	    //* 检查验证码是否正确
	    //$validator = new captcha();
	    $img = new captcha(ROOTPATH . 'data/captcha/',80,40);
	    @ob_end_clean(); //清除之前出现的多余输入
	    $code = $img->generate_image();
	    /* 记录验证码到session*/
	    $word = $code['word'];
	    $this->session->set_userdata('yzcode', $word); 
	}

}