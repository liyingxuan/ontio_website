<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sites extends CI_Controller {
	/**
	 * Index Page for this controller.
	 */
    public function __construct() {
        parent::__construct();
        $this->load->Model('System');
    }
     /***
     * 站点设置
     * @author: 了念
     ***/
    public function site_setting()
    {
        $arr = $this->System->getSystemValue();
        $this->smarty->assign('settings', $arr['data']);
    	if($_POST)
    	{
    		foreach ($_POST as $key => $data) {
	            if (!empty($data)) {
	                $data = trim($data);
	                $arr = array('key' => $key, 'value' => $data);
	                $res = $this->System->updateSystemValue($arr);
	                if (!$res['state']) {
	                    echo json_encode(array('state' => false, 'msg' => $res['msg'], 'data' => ''));exit;
	                }
	                $res = $this->System->logAction('修改站点信息' . $key . '为' . $data, __METHOD__);
	                if (!$res['state']) {
	                    echo json_encode(array('state' => false, 'msg' => $res['msg'], 'data' => ''));exit;
	                }
	            }
	        }
          echo json_encode(array('state' => true, 'msg' => '设置成功', 'data' => ''));exit;
    	}
    	else{
    	  $this->smarty->assign('user_name',$_SESSION['admin_name']);
	      $this->smarty->assign('role_name',$_SESSION['admin_role_name']);
    	  $this->smarty->display('siteSetting.html');
    	}
    }
     /***
     * 系统操作日志
     * @author: 了念
     ***/
	public function system_log() {
		$this->System->isPriv("user_log"); //权限
		if ($_POST) {
			$page = isset($_POST['curpage']) ? $_POST['curpage']+1: 0;
			$rp = isset($_POST['rp']) ? $_POST['rp'] : 40;
			$sortname = isset($_POST['ordername']) ? $_POST['ordername'] : 'log_time';
			$sortorder = isset($_POST['order']) ? $_POST['order'] : 'desc';
			$search = isset($_POST['search'])?$_POST['search']:false;
			$where = ' 1=1 ';
			$this->load->model('Admin');
			$res = $this->Admin->getAdminLog($where, $sortname, $sortorder, ceil($page/$rp), $rp);
			foreach ($res['data']['datas'] as $key => $row) {
				$res['data']['datas'][$key]['log_time'] = empty($row['log_time']) ? '-' : date('Y-m-d H:i:s', $row['log_time']);
			}
			$data['total'] = $res['data']['count'];
			$data['rows'] = $res['data']['datas'];
			echo json_encode($data);die;
		} else {
			$this->smarty->display('systemLog.html');
		}
	}
     /***
     * 系统操作日志单个或多个删除
     * @author: 了念
     ***/
	public function system_log_del() {
		$this->System->isPriv("user_log"); //权限
		$ids= isset($_GET['del_id']) ? $_GET['del_id'] : '';
		$this->load->model('Admin');
		$res = $this->Admin->delAdminLog('log_id  in ('.$ids.')');
		 if ($res['state']) {
	 		$res = $this->System->logAction('删除日志ID为' . $ids, __METHOD__);
			echo json_encode(array('state' => true, 'msg' => '删除成功', 'data' => ''));exit;
		} else {
			echo json_encode(array('state' => false, 'msg' => $res['msg'], 'data' => ''));exit;
		}
	}
     /***
     * 删除六个月前的系统操作日志
     * @author: 了念
     ***/
	public function system_log_del_6monthAgo() {
		$this->System->isPriv("user_log"); //权限
		$time = time();
		$condition = $time - 180 * 86400;
		$this->load->model('Admin');
		$res = $this->Admin->delAdminLog("log_time <=" . $condition);
		if ($res['state']) {
			$res = $this->System->logAction('删除管理日志6个月前的日志', __METHOD__);
			echo json_encode(array('state' => true, 'msg' => '删除成功', 'data' => ''));exit;
		} else {
			echo json_encode(array('state' => false, 'msg' => $res['msg'], 'data' => ''));exit;
		}
	}
     /***
     * 导出管理员日志
     * @author: 了念
     ***/
	public function admin_log_export() {
		$this->System->isPriv("user_log"); //权限
		$page = isset($_POST['curpage']) ? $_POST['curpage'] : 1;
		$rp = isset($_POST['rp']) ? $_POST['rp'] : 40;
		$sortname = isset($_POST['sortname']) ? $_POST['sortname'] : 'log_time';
		$sortorder = isset($_POST['sortorder']) ? $_POST['sortorder'] : 'desc';
		$query = isset($_POST['query']) ? $_POST['query'] : false; //搜索查询的条件11
		$qtype = isset($_POST['qtype']) ? $_POST['qtype'] : false; //搜索查询的类别admin
		$this->load->library('phpExcel');
		//include(ROOT_PATH . 'libraries/phpExcel/PHPExcel.php');
		/* 没有传过来id数据 */

		$id_str = empty($_GET['id']) || $_GET['id'] == '' ? 'all' : $_GET['id'];
		// 注：若id为0，也返回true
		$where = ' 1=1 ';
		if ($id_str == 'all') {
			$where .= '';
		} else {
			$where .= " and log_id in ($id_str)";
		}
		if ($query && $qtype) {
			$where .= " AND $qtype LIKE '%$query%' ";
		}
		$this->db->select('*');
		$this->db->from('admin_log');
		$this->db->where($where);
		$this->db->order_by($sortname, $sortorder);
		$this->db->limit($rp, $rp*($page-1));
    // $this->db->limit(0,20);
		$rows = $this->db->get()->result_array();
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setCreator('jk')
			->setLastModifiedBy('jk')
			->setTitle('Office 2007 XLSX Document')
			->setSubject('Office 2007 XLSX Document')
			->setDescription('Document for Office 2007 XLSX, generated using PHP classes.')
			->setKeywords('office 2007 openxml php')
			->setCategory('Result file');
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A1', 'ID')
			->setCellValue('B1', '操作人')
			->setCellValue('C1', '操作内容')
			->setCellValue('D1', '操作时间')
			->setCellValue('E1', 'IP地址');

		$i = 2;
		foreach ($rows as $k => $v) {
			$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A' . $i, $v['log_id'])
				->setCellValue('B' . $i, $v['admin_name'])
				->setCellValue('C' . $i, $v['log_content'])
				->setCellValue('D' . $i, date('Y-m-d H:i:s', $v['log_time']))
				->setCellValue('E' . $i, $v['ip']);
			$i++;
		}
		$objPHPExcel->getActiveSheet()->setTitle('admin_log');
		$objPHPExcel->setActiveSheetIndex(0);
		$filename = urlencode('管理员日志') . '_' . date('Y-m-dHis');

		/*
			           *生成xlsx文件
			           header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			           header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
			           header('Cache-Control: max-age=0');
			           $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
		*/
		ob_end_clean();
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$aaa = $objWriter->save('php://output');
		exit;
	}
     /***
     * 系统管理员列表
     * @author: 了念
     ***/
	public function admin() {
		$this->System->isPriv("user_list"); //权限
		if (isset($_POST['offset'])) { //POST提交
			$page = isset($_POST['offset']) ? $_POST['offset']+1: 0;
			$rp = isset($_POST['limit']) ? $_POST['limit'] : 10;
			$sortname = isset($_POST['ordername']) ? $_POST['ordername'] : 'admin_login_time'; //排序条件
			$sortorder = isset($_POST['order']) ? $_POST['order'] : 'desc'; //升序/降序
			$where = '1=1';
			$this->load->model('Admin');
			$res = $this->Admin->getAdmin($where, $sortname, $sortorder, ceil($page/$rp), $rp);
			foreach ($res['data']['datas'] as $key => $row) {
				$res['data']['datas'][$key]['admin_login_time'] = empty($row['admin_login_time']) ? '-' : date('Y-m-d H:i:s', $row['admin_login_time']);
			}
			$data['total'] = $res['data']['count'];
			$data['rows'] = $res['data']['datas'];

			echo json_encode($data);die;
		} else {
			$this->smarty->display('admins.html');
		}
	}
     /***
     * 管理员添加&编辑
     * @author: 了念
     ***/
	public function admin_edit() {
		$this->System->isPriv("user_list"); //权限
		$this->load->model('Admin');
		if ($_POST) {
			$admin_name = isset($_POST['admin_name']) ? trim($_POST['admin_name']) : '';
			$admin_id = isset($_POST['admin_id']) ? $_POST['admin_id'] :false;
			$admin_pwd = isset($_POST['admin_pwd']) ? trim($_POST['admin_pwd']) : '';
			$role_id = isset($_POST['role_id']) ? intval($_POST['role_id']) : '';
			$admin_ture_name = isset($_POST['admin_ture_name']) ? trim($_POST['admin_ture_name']) : '';
			$admin_tel = isset($_POST['admin_tel']) ? trim($_POST['admin_tel']) : '';
			$admin_pwd = sha1($admin_pwd);
			$time = time();
			$ip = real_ip();
			if($admin_id)//编辑管理员
			{
				$data = array('role_id' => $role_id,
					'admin_name' => $admin_name,
					'admin_pwd' => $admin_pwd,
					'admin_ture_name' => $admin_ture_name,
					'admin_tel' => $admin_tel		
				);
				$res = $this->Admin->editAdmin($data, array('admin_id' => $admin_id));
				if ($res) {
					$res = $this->System->logAction('编辑管理员' . $admin_name, __METHOD__);
					echo json_encode(array('state'=>true,'msg'=>'编辑成功'));die;
				} else {
					echo json_encode(array('state'=>true,'msg'=>'编辑失败'));die;
				}
			}
			else{
				$data = array('role_id' => $role_id,
					'admin_name' => $admin_name,
					'admin_pwd' => $admin_pwd,
					'admin_ture_name' => $admin_ture_name,
					'admin_tel' => $admin_tel,
				);
				$res = $this->Admin->addAdmin($data);
			   if ($res) {
				$res = $this->System->logAction('新增管理员' . $admin_name, __METHOD__);
					echo json_encode(array('state'=>true,'msg'=>'添加成功'));die;
				} else {
					echo json_encode(array('state'=>false,'msg'=>'添加失败'));die;
				}
			}
		} else {
			$admin_id = isset($_GET['admin_id']) ? $_GET['admin_id'] : '';
			$admin = $this->Admin->getAdmin('admin_id=' . $admin_id);
			$roles = $this->Admin->getRoles();
			$this->smarty->assign('roles', $roles['data']['datas']);
			if($admin['state'])
			{
				if($admin['data']['count']==1)
				{
					$this->smarty->assign('admin', $admin['data']['datas'][0]);
				}
				else{
					
				}
			}else{
				
			}
			$this->smarty->display('adminInfo.html');
		}
	}
     /***
     * 管理员删除
     * @author: 了念
     ***/
	public function admin_del() {
		$this->System->isPriv("user_list"); //权限
		$ids = isset($_GET['id']) ? $_GET['id'] : '';
	    $this->load->model('Admin');
		$res = $this->Admin->delAdmin($ids);
		if ($res['state']) {
			$res = $this->System->logAction('删除管理员ID为' . $ids, __METHOD__);
			echo json_encode(array('state' => true, 'msg' => '删除成功', 'data' => ''));exit;
		} else {
			echo json_encode(array('state' => false, 'msg' => $res['msg'], 'data' => ''));exit;
		}
	}
	// 管理帐号是否存在
	public function admin_check_name() {
		$admin_id = isset($_GET['admin_id']) ? trim($_GET['admin_id']) : false; //如果有admin_id则为编辑,否则为添加
		$admin_name = isset($_GET['admin_name']) ? trim($_GET['admin_name']) : false;
		//编辑
		if($admin_id && $admin_name){
			$where = array('admin_id !='=>$admin_id,'admin_name'=>$admin_name);

			$res = $this->Admin->getAdmin2($where);
			if($res['state'] && $res['data']['count']>0){
				echo "false";exit;
			}else{
				echo "true";exit;
			}
		}
		//添加
		if(!$admin_id){
			$where = array('admin_name'=>$admin_name);
			$res = $this->Admin->getAdmin2($where);
			if($res['data']['count']==0){
				echo "true";exit;
			}else{
				echo "false";exit;
			}
		}

	}
	//手机号是否存在
	public function admin_check_tel() {

		$admin_id = isset($_GET['admin_id']) ? trim($_GET['admin_id']) : false; //如果有admin_id则为编辑,否则为添加
		$admin_tel = isset($_GET['admin_tel']) ? trim($_GET['admin_tel']) : false;
		//编辑验证手机号
		if($admin_id && $admin_tel){
			$where = "admin_id != $admin_id AND admin_tel = $admin_tel";
			$res = $this->Admin->getAdmin($where);
			if($res['state'] && $res['data']['count']>0){
				echo "false";exit;
			}else{
				echo "true";exit;
			}
		}
		//添加验证手机号
		if(!$admin_id){
			$where = "admin_tel = $admin_tel";
			$res = $this->Admin->getAdmin($where);
			if($res['data']['count']==0){
				echo "true";exit;
			}else{
				echo "false";exit;
			}
		}

	}
     /***
     * 系统管理角色
     * @author: 了念
     ***/
	public function role() {
		$this->System->isPriv("role_management"); //权限
		if (isset($_POST['offset'])) { //POST提交
			$page = isset($_POST['offset']) ? $_POST['offset']+1 : 0;
			$rp = isset($_POST['limit']) ? $_POST['limit'] : 10;
			$sortname = isset($_POST['ordername']) ? $_POST['ordername'] : 'admin_login_time'; //排序条件
			$sortorder = isset($_POST['order']) ? $_POST['order'] : 'desc'; //升序/降序
			
			$where = '1=1';
            $this->load->model('Admin');
			$res = $this->Admin->getRoles($where, $sortname, $sortorder, ceil($page/$rp), $rp);
			$data['total'] = $res['data']['count'];
			$data['rows'] = $res['data']['datas'];

			echo json_encode($data);die;
		} else {
			$this->smarty->display('roles.html');
		}
	}
     /***
     * 角色编辑
     * @author: 了念(雷鼎修改)
     ***/
	public function role_edit() {
		$this->System->isPriv("role_management"); //权限
		$this->load->model('Admin');
		if ($_POST) {
			$role_id = isset($_POST['role_id']) && is_numeric($_POST['role_id']) ? trim($_POST['role_id']) : false;
			$role_name = isset($_POST['role_name']) ? trim($_POST['role_name']) : '';
			$role_comments = isset($_POST['role_comments']) ? trim($_POST['role_comments']) : ''; 
			$priv_arr = isset($_POST['permission']) ? $_POST['permission'] : array();
			$priv_arr = array_unique($priv_arr); //去重 有可能两个权限对应一个权限码的情况
			$act_list = @join(",", $priv_arr);
			if($role_id)
			{
				$data = array(
					'role_name' => $role_name,
					'role_actions' => $act_list,
					'role_comments' => $role_comments,
				);
				$res = $this->Admin->editRole($data, array('role_id' => $role_id));
				if ($res['state']) {
					$this->System->logAction('编辑角色' . $role_name, __METHOD__);
					echo json_encode(array('state'=>true,'msg'=>$res['msg'],'data'=>''));exit;
				} else {
					echo json_encode(array('state'=>false,'msg'=>$res['msg'],'data'=>''));exit;
				}
			}else{ 
				$data = array(
					'role_name' => $role_name,
					'role_actions' => $act_list,
					'role_comments' => $role_comments,
				);
				$res = $this->Admin->addRole($data);
				if ($res['state']) {
					$this->System->logAction('新增角色' . $role_name, __METHOD__);
					echo json_encode(array('state'=>true,'msg'=>$res['msg'],'data'=>''));exit;
				} else { 
					echo json_encode(array('state'=>false,'msg'=>$res['msg'],'data'=>''));exit;
				}
			}
		} else {
			$role_id = isset($_GET['role_id']) ? $_GET['role_id'] : '';
			$role = $this->Admin->getRoles("role_id='$role_id'");
			if(!$role['state']){
				echo exit(json_encode(array('state'=>false,'msg'=>'获取权限数据失败'.$res['msg'],'data'=>'')));
			} 
			if($role['data']['count']>0)
			{
			  $role['data']['datas'][0]['role_actions'] = explode(',', $role['data']['datas'][0]['role_actions']);
		      $this->smarty->assign('role', $role['data']['datas'][0]);
			} 
			$privs = $this->System->getActionList(); 
			$this->smarty->assign('privs', $privs['data']);
			$this->smarty->display('roleInfo.html');
		}

	}
	/**角色删除
	*@author:雷鼎
	**/ 
	public function role_del() {
		$this->System->isPriv("role_management"); //权限
		$this->load->model('Admin');
		$role_id = isset($_GET['role_id']) && is_numeric($_GET['role_id']) ? $_GET['role_id'] : '';
		$ids = explode(',', $role_id);
		foreach ($ids as $key => $id) {
			$res = $this->Admin->delRole($id);
			if ($res['state']) {
				$res = $this->System->logAction('删除角色ID为' . $id, __METHOD__);
				echo json_encode(array('state' => true, 'msg' => '删除成功', 'data' => ''));exit;
			} else {
				echo json_encode(array('state' => false, 'msg' =>'删除失败'.$res['msg'], 'data' => ''));exit;
			}
		} 
	}

	/**角色删除
	*@author:雷鼎
	**/ 
	// 判断角色是否存在
	public function role_check_name() {
		$this->load->model('Admin');
		$role_id = isset($_GET['role_id']) ? trim($_GET['role_id']) : false; //如果有admin_id则为编辑,否则为添加
		$role_name = isset($_GET['role_name']) ? trim($_GET['role_name']) : false;
		
		//编辑
		if($role_id && $role_name){
			//$where = array('role_id !='=>$role_id,'role_name'=>$role_name);
			$where = "role_id != '{$role_id}' and role_name = '{$role_name}'";
			$res = $this->Admin->getroles($where);
			if($res['state'] && $res['data']['count']>0){
				echo exit(json_encode(array('state'=>false,'msg'=>'该权限组已存在,请更换为其他名字','data'=>'')));
			}else{
				echo "true";exit;
			}
		}
		//添加
		if(!$role_id){
			$where = "role_name = '{$role_name}'";
			$res = $this->Admin->getroles($where);
			if($res['state'] && $res['data']['count']>0){
				// echo exit(json_encode(array('state'=>false,'msg'=>'该权限组已存在,请更换为其他名字','data'=>'')));
				echo "false";exit;
			}else{
				// echo exit(json_encode(array('state'=>true,'msg'=>'','data'=>'')));
				echo "true";exit;
			}
		}

	}
	 /***
     * 站点语言
     * @author: 了念 
     ***/
	public function language() {
		$this->System->isPriv("language");
		$this->load->model("Admin");
		if($_POST){
			$page=isset($_POST["start"]) ? $_POST["start"]:0;
	    	$rp  =isset($_POST["length"]) ? $_POST["length"]:50;
	    	//后台排序
	    	$orderArr = isset($_POST['order']) ? $_POST['order'] : '';
	    	$sortType = "desc";
            $sortName = "lgid";
            if(!empty($orderArr)){
                if(!isset($orderArr[1])){
                    $sortType = $orderArr[0]['dir'];
                    switch ($orderArr[0]['column']){
                        case '1':
                            $sortName = "lgid";
                            break;
                        case '2':
                            $sortName = "language_title";
                            break;
                        case '3':
                            $sortName = "language_desc";
                            break;
                        case '4':
                            $sortName = "language_keywords";
                            break; 
                        default:
                            $sortName = "lgid";
                    }
                } 
            }
            $where ="1=1";
            $key ="*";
            $order_by=$sortName.' '.$sortType;
            $limit=array('limit'=>true,'curpage'=>$page,'rp'=>$rp);
            $res=$this->Admin->getAllLanguage($where,$key,$order_by,$limit);
	    	if(!$res['state']){
	    		echo exit(json_encode(array('state'=>false,'msg'=>'获取数据失败'.$res['msg'],'data'=>'')));
	    	} 
	        if(empty($res['data']['datas'])){
	            $datas=array(
	              "sEcho"=>$this->input->get('sEcho',true),
	              "iTotalDisplayRecords"=>0,
	              "iTotalRecords"=>0,
	              "aaData"=>array()
	            );
	            echo exit(json_encode($datas));die;
	        }
	        $list=$res['data']['datas'];
            $datas=array(
              "sEcho"=>$this->input->get('sEcho',true),
              "iTotalDisplayRecords"=>intval($res['data']['count']),
              "iTotalRecords"=>intval($res['data']['count']),
              "aaData"=>$list
            ); 
            echo exit(json_encode($datas));
		}else{
			$this->smarty->display('language.html');
		} 
	}

	/**
	* 编辑语言站点（新增站点语言）
	* @author: MS zhang
	**/
	public function language_edit(){
		$this->System->isPriv("language");
		$this->load->model('Admin');
		if($_POST){
			$lgid =isset($_POST['lgid']) && !empty($_POST['lgid']) ? $_POST['lgid'] :"";
			$language =isset($_POST['language']) && !empty($_POST['language']) ? trim($_POST['language']) :"";
			$language_title =isset($_POST['language_title']) && !empty($_POST['language_title']) ? trim($_POST['language_title']):"";
			$language_keywords =isset($_POST['language_keywords']) && !empty($_POST['language_keywords']) ? trim($_POST['language_keywords']) :"";
			$language_desc =isset($_POST['language_desc']) && !empty($_POST['language_desc']) ? trim($_POST['language_desc']) :"";
			if(empty($language)){
				echo exit(json_encode(array('state'=>false,'msg'=>'语言名称不能为空','data'=>'')));
			}
			if(empty($language_title)){
				echo exit(json_encode(array('state'=>false,'msg'=>'站点标题不能为空','data'=>'')));
			}
			if(empty($language_keywords)){
				echo exit(json_encode(array('state'=>false,'msg'=>'站点关键字不能为空','data'=>'')));
			}
			if(empty($language_desc)){
				echo exit(json_encode(array('state'=>false,'msg'=>'站点描述不能为空','data'=>'')));
			}
			$data = array(
				'language' => $language,
				'language_title' => $language_title,
				'language_desc' => $language_desc,
				'language_keywords'=>$language_keywords
			);
			if(!empty($lgid)){//编辑 
				$res = $this->Admin->editLanguage($data,"lgid=".$lgid);
				if(!$res['state']) {
					echo exit(json_encode(array('state'=>false,'msg'=>'编辑站点语言失败'.$res['msg'],'data'=>'')));
				}
			    $this->System->logAction('编辑站点语言ID号:'.$lgid .'，站点语言名:'. $language, __METHOD__);
				echo exit(json_encode(array('state'=>true,'msg'=>'操作成功','data'=>'')));
			}else{ //新增
				$res = $this->Admin->addLanguage($data);
				if(!$res['state']) {
					echo exit(json_encode(array('state'=>false,'msg'=>'新增站点语言失败'.$res['msg'],'data'=>'')));
				}
			    $this->System->logAction('新增站点语言站点语言名:'. $language, __METHOD__); 
				echo exit(json_encode(array('state'=>true,'msg'=>'操作成功','data'=>'')));
			}
		}else{
			$lgid=isset($_GET['lgid']) && !empty($_GET['lgid']) ? $_GET['lgid'] : "";
			if(!empty($lgid)){
				$where ="lgid =".$lgid;
				$res=$this->Admin->getByLanguage($where);
				if(!$res['state']){
					echo "获取数据失败";
				} 
				$this->smarty->assign("language",$res['data']);
			}  
			$this->smarty->display('languageInfo.html');
		}
	}
	/**
	 * 删除语言站点数据
	 * @return：true 操作成功  false 操作失败 
	 * @author:MS zhang
	 **/
	public function language_del()
	{
		$this->System->isPriv("language");
		$this->load->model('Admin');
		$lgid=isset($_GET['lgid']) ? $_GET['lgid'] : '';
		if(empty($lgid)){
			echo exit(json_encode(array('state'=>false,'msg'=>'请选择要操作的数据项','data'=>'')));
		}
		$res=$this->Admin->delLanguage("lgid IN ($lgid)");
		if(!$res['state']){
			echo exit(json_encode(array('state'=>false,'msg'=>'系统错误，数据操作失败：'.$res['msg'],'data'=>'')));
		}
		$this->System->logAction('删除站点语言ID号为:'. $lgid, __METHOD__); 
		echo exit(json_encode(array('state'=>true,'msg'=>'删除成功','data'=>'')));
	} 

 	/***
     * 友情链接
     * @author: MS zhang
     ***/
	public function flink() {
		$this->System->isPriv("flink");
		$this->load->model("Admin");
		if($_POST){
			$page=isset($_POST["start"]) ? $_POST["start"]:0;
	    	$rp  =isset($_POST["length"]) ? $_POST["length"]:50;
	    	//后台排序
	    	$orderArr = isset($_POST['order']) ? $_POST['order'] : '';
	    	$sortType = "desc";
            $sortName = "link_sort";
            if(!empty($orderArr)){
                if(!isset($orderArr[1])){
                    $sortType = $orderArr[0]['dir'];
                    switch ($orderArr[0]['column']){
                        case '1':
                            $sortName = "link_title";
                            break;
                        case '2':
                            $sortName = "link_title";
                            break;
                        case '3':
                            $sortName = "link_url";
                            break;
                        case '4':
                            $sortName = "link_sort";
                            break; 
                        default:
                            $sortName = "link_id";
                    }
                } 
            }
            $where ="1=1";
            $key ="*";
            $order_by=$sortName.' '.$sortType;
            $limit=array('limit'=>true,'curpage'=>$page,'rp'=>$rp);
            $res=$this->Admin->getAllLink($where,$key,$order_by,$limit);
	    	if(!$res['state']){
	    		echo exit(json_encode(array('state'=>false,'msg'=>'获取数据失败'.$res['msg'],'data'=>'')));
	    	} 
	        if(empty($res['data']['datas'])){
	            $datas=array(
	              "sEcho"=>$this->input->get('sEcho',true),
	              "iTotalDisplayRecords"=>0,
	              "iTotalRecords"=>0,
	              "aaData"=>array()
	            );
	            echo exit(json_encode($datas));die;
	        }
	        $list=$res['data']['datas'];
            $datas=array(
              "sEcho"=>$this->input->get('sEcho',true),
              "iTotalDisplayRecords"=>intval($res['data']['count']),
              "iTotalRecords"=>intval($res['data']['count']),
              "aaData"=>$list
            ); 
            echo exit(json_encode($datas));
		}else{
			$this->smarty->display('flink.html');
		} 
	}
	/**
	* 编辑或(新增)友情链接
	* @author: Mr zhang
	**/
	public function flink_edit(){
		$this->System->isPriv("flink");
		$this->load->model('Admin'); 
		if($_POST || $_FILES){
			$link_id =isset($_POST['link_id']) && !empty($_POST['link_id']) ? trim($_POST['link_id']) :"";
			$link_title =isset($_POST['link_title']) && !empty($_POST['link_title']) ? trim($_POST['link_title']) :"";
			$link_url =isset($_POST['link_url']) && !empty($_POST['link_url']) ? trim($_POST['link_url']) :""; 
			$link_sort =isset($_POST['link_sort']) && !empty($_POST['link_sort']) ? trim($_POST['link_sort']) :"";
			$is_pic =isset($_POST['is_pic']) && !empty($_POST['is_pic']) ? $_POST['is_pic'] :""; 
			if(empty($link_title)){
				echo exit(json_encode(array('state'=>false,'msg'=>'链接标题不能为空','data'=>'')));
			}
			if(empty($link_url)){
				echo exit(json_encode(array('state'=>false,'msg'=>'链接地址不能为空','data'=>'')));
			}
			$pic_path="";
			if(!empty($is_pic)){
				$file_name=isset($_FILES['file']['name'])?$_FILES['file']['name']:'';//图片名
				$file_tmpname=isset($_FILES['file']['tmp_name'])?$_FILES['file']['tmp_name']:'';//上传临时文件名 
				$file_size=isset($_FILES['file']['size'])?$_FILES['file']['size']:'';//上传临时文件大小
				$error=isset($_FILES['file']['error'])?$_FILES['file']['error']:'';//上传错误信息
		        if(!empty($error)){
					echo json_encode(array('state'=>false,'msg'=>'上传图片错误信息:'.$error,'data'=>''));exit;  
				}
				if($file_size>10*1024*1024){
		        	echo json_encode(array('state'=>false,'msg'=>'上传图片最大为10MB','data'=>''));exit;  
		        }
		        $last_name=trim(strrchr($file_name, '.'),'.'); 
		        $last_name=strtolower($last_name);
		        if($last_name !='png' && $last_name !='jpg' && $last_name !='jpeg'  && $last_name !='bmp' ){
		        	echo exit(json_encode(array('state'=>false,'msg'=>'请上传png|jpg|jpeg|bmp格式图片','data'=>'')));
		        }
		        //判断文件夹是否存在 不存在则创建
				$dir="data/flink/";
				if(!is_dir($dir) ){
	            	mkdir($dir,0777);
	            }
			}
			$this->db->trans_begin(); 
			if(!empty($link_id)){//编辑 
				if(!empty($is_pic)){
					$res=$this->Admin->getByLink("link_id ='$link_id'","link_pic");
					if(!$res['state']){
						$this->db->trans_rollback();
						echo exit(json_encode(array('state'=>false,'msg'=>'系统错误，获取单条数据失败：'.$res['msg'],'data'=>'')));
					} 
					if(!empty($res['data']['link_pic'])){
						$is_files=ROOTPATH.$res['data']['link_pic'];
						if(file_exists($is_files))
						{
						    if (!unlink($is_files)){
						    	$this->db->trans_rollback();
						    	echo exit(json_encode(array('state'=>false,'msg'=>'删除原有图片失败'.$is_files,'data'=>'')));
						    }
						}
					}
		            //$pic = date("YmdHis").rand(100, 999).'.'. $last_name; 
		            $pic ='flink_'.$link_id.'.'.$last_name;
		            $pic_path =$dir. $pic;
		            if(!move_uploaded_file($_FILES['file']['tmp_name'],$pic_path)){
		            	$this->db->trans_rollback();
						echo exit(json_encode(array('state'=>false,'msg'=>'图片上传失败','data'=>'')));  
					}
					$data = array(
						'link_title' => $link_title,
						'link_pic' => $pic_path,
						'link_url' => $link_url,
						'link_sort'=>$link_sort
					);
				}else{
					$data = array(
						'link_title' => $link_title,
						'link_url' => $link_url,
						'link_sort'=>$link_sort
					);
				}
				$res = $this->Admin->editLink($data,"link_id=".$link_id);
				if(!$res['state']) {
					$this->db->trans_rollback();
					echo exit(json_encode(array('state'=>false,'msg'=>'编辑友情链接失败'.$res['msg'],'data'=>'')));
				}
				$this->db->trans_commit(); 
			    $this->System->logAction('编辑友情链接ID号:'.$link_id .'，站点链接名:'. $link_title, __METHOD__);
				echo exit(json_encode(array('state'=>true,'msg'=>'操作成功','data'=>'')));
			}else{ //新增 
				$data = array(
					'link_title' => $link_title,
					'link_pic' => $pic_path,
					'link_url' => $link_url,
					'link_sort'=>$link_sort
				);
				$res = $this->Admin->addLink($data);
				$add_id=$res['data'];//新增数据id
				if(!$res['state']) {
					$this->db->trans_rollback();
					echo exit(json_encode(array('state'=>false,'msg'=>'新增友情链接失败'.$res['msg'],'data'=>'')));
				}
				if(!empty($is_pic)){ 
		            $pic ='flink_'.$add_id.'.'.$last_name;
		            $pic_path =$dir.$pic;
		            if(!move_uploaded_file($_FILES['file']['tmp_name'],$pic_path)){
		            	$this->db->trans_rollback();
						echo exit(json_encode(array('state'=>false,'msg'=>'图片上传失败','data'=>'')));  
					}
					$data = array( 
						'link_pic' => $pic_path
					);
					$res = $this->Admin->editLink($data,"link_id=".$add_id);
					if(!$res['state']) {
						$this->db->trans_rollback();
						echo exit(json_encode(array('state'=>false,'msg'=>'编辑友情链接失败'.$res['msg'],'data'=>'')));
					} 
				}
				$this->db->trans_commit(); 
			    $this->System->logAction('新增友情链接名:'. $link_title, __METHOD__); 
				echo exit(json_encode(array('state'=>true,'msg'=>'操作成功','data'=>'')));
			}
		}else{
			$link_id=isset($_GET['link_id']) && !empty($_GET['link_id']) ? $_GET['link_id'] : "";
			if(!empty($link_id)){
				$where ="link_id =".$link_id;
				$res=$this->Admin->getByLink($where); 
				if(!$res['state']){
					echo "获取数据失败";
				} 
				$this->smarty->assign("link",$res['data']);
			}  
			$this->smarty->display('flinkInfo.html');
		}
	}

	/**
	 * 删除友情链接数据
	 * @return：true 操作成功  false 操作失败 
	 * @author:Mr zhang
	 **/
	public function flink_del()
	{
		$this->System->isPriv("flink");
		$this->load->model('Admin');
		$link_id=isset($_GET['link_id']) ? $_GET['link_id'] : '';
		if(empty($link_id)){
			echo exit(json_encode(array('state'=>false,'msg'=>'请选择要操作的数据项','data'=>'')));
		}
		$this->db->trans_begin(); 
		$res=$this->Admin->getByLink("link_id ='$link_id'","link_pic");
		if(!$res['state']){
			echo exit(json_encode(array('state'=>false,'msg'=>'系统错误，获取单条数据失败：'.$res['msg'],'data'=>'')));
		} 
		if(!empty($res['data']['link_pic'])){
			$is_files=ROOTPATH.$res['data']['link_pic'];
			if(file_exists($is_files))
			{
			    if (!unlink($is_files)){
			    	$this->db->trans_rollback(); 
			    	echo exit(json_encode(array('state'=>false,'msg'=>'删除原有图片失败'.$is_files,'data'=>'')));
			    }
			}
		}
		$res=$this->Admin->delLink("link_id IN ($link_id)");
		if(!$res['state']){
			$this->db->trans_rollback();
			echo exit(json_encode(array('state'=>false,'msg'=>'系统错误，数据操作失败：'.$res['msg'],'data'=>'')));
		}
		$this->db->trans_commit(); 
		$this->System->logAction('删除友情ID号为:'. $link_id, __METHOD__); 
		echo exit(json_encode(array('state'=>true,'msg'=>'删除成功','data'=>'')));
	} 

	/**
	* 广告位管理主页面
	* @author： Mr zhang
	**/
	public function advert()
	{
		$this->System->isPriv("advert");
		$this->load->model('Admin'); 
		if($_POST){
			$page=isset($_POST["start"]) ? $_POST["start"]:0;
	    	$rp  =isset($_POST["length"]) ? $_POST["length"]:50;
	    	// var_dump($_POST);die;
	    	//后台排序
	    	$orderArr = isset($_POST['order']) ? $_POST['order'] : '';
	    	$sortType = "desc";
            $sortName = "a.ap_id"; 
            if(!empty($orderArr)){ 
                if(!isset($orderArr[1])){ 
                    $sortType = $orderArr[0]['dir'];
                    switch ($orderArr[0]['column']){
                        case '1':
                            $sortName = "ap_id";
                            break;
                        case '2':
                            $sortName = "ap_class";
                            break;
                        case '3':
                            $sortName = "ap_width";
                            break;
                        case '4':
                            $sortName = "ap_height";
                            break; 
                        case '5':
                            $sortName = "is_use";
                            break;
                        default:
                            $sortName = "ap_name";
                    }
                } 
            }
            $where ="1=1";
            $key ="a.*,d.adv_id";
            $order_by=$sortName.' '.$sortType;
            $limit=array('limit'=>true,'curpage'=>$page,'rp'=>$rp);
            $group_by="a.ap_id";
            $res=$this->Admin->getAllAdvertPosition($where,$key,$order_by,$limit,$group_by);
	    	if(!$res['state']){
	    		echo exit(json_encode(array('state'=>false,'msg'=>'获取数据失败'.$res['msg'],'data'=>'')));
	    	} 
	        if(empty($res['data']['datas'])){
	            $datas=array(
	              "sEcho"=>$this->input->get('sEcho',true),
	              "iTotalDisplayRecords"=>0,
	              "iTotalRecords"=>0,
	              "aaData"=>array()
	            );
	            echo exit(json_encode($datas));die;
	        }
	        $list=$res['data']['datas'];
            $datas=array(
              "sEcho"=>$this->input->get('sEcho',true),
              "iTotalDisplayRecords"=>intval($res['data']['count']),
              "iTotalRecords"=>intval($res['data']['count']),
              "aaData"=>$list
            );
            echo exit(json_encode($datas));
		}else{
			$this->smarty->display('advert.html');
		}
	}

	/**
	* 编辑广告位置表
	* @author: Mr zhang
	**/
	public function advert_edit(){
		$this->System->isPriv("advert");
		$this->load->model('Admin');
		if($_POST){
			$ap_id =isset($_POST['ap_id']) && !empty($_POST['ap_id']) ? $_POST['ap_id'] :"";
			$ap_name =isset($_POST['ap_name']) && !empty($_POST['ap_name']) ? trim($_POST['ap_name']) :"";
			$ap_width =isset($_POST['ap_width']) && !empty($_POST['ap_width']) ? trim($_POST['ap_width']) :0;
			$ap_height =isset($_POST['ap_height']) && !empty($_POST['ap_height']) ? trim($_POST['ap_height']) :0;
			$ap_class =isset($_POST['ap_class']) ? $_POST['ap_class'] :"";
			$ap_display =isset($_POST['ap_display']) ? $_POST['ap_display'] :"";
			$is_use =isset($_POST['is_use']) ? $_POST['is_use'] :"";
			$ap_intro =isset($_POST['ap_intro']) && !empty($_POST['ap_intro']) ? trim($_POST['ap_intro']) :"";
			
			if(empty($ap_name)){
				echo exit(json_encode(array('state'=>false,'msg'=>'广告位名称不能为空','data'=>'')));
			}
			if(!empty($ap_width) && !preg_match("/(^[1-9]\d*(\.\d{1,2})?$)|(^0(\.\d{1,2})?$)/",$ap_width)){
				echo exit(json_encode(array('state'=>false,'msg'=>'广告位宽度只能是整数或两位内小数','data'=>'')));
			}
			if(!empty($ap_height) && !preg_match("/(^[1-9]\d*(\.\d{1,2})?$)|(^0(\.\d{1,2})?$)/",$ap_height)){
				echo exit(json_encode(array('state'=>false,'msg'=>'广告位高度只能是整数或两位内小数','data'=>'')));
			}
			$data = array(
				'ap_name' => $ap_name,
				'ap_intro' => $ap_intro,
				'ap_class' => $ap_class,
				'ap_display'=>$ap_display, 
				'is_use'=>$is_use, 
				'ap_width' => $ap_width,
				'ap_height' => $ap_height
			);
			if(!empty($ap_id)){//编辑 
				$res = $this->Admin->editAdvert($data,"ap_id=".$ap_id);
				if(!$res['state']) {
					echo exit(json_encode(array('state'=>false,'msg'=>'编辑站点语言失败'.$res['msg'],'data'=>'')));
				}
			    $this->System->logAction('编辑广告位ID号:'.$ap_id .'，广告位名:'. $ap_name, __METHOD__);
				echo exit(json_encode(array('state'=>true,'msg'=>'操作成功','data'=>'')));
			}else{ //新增
				$res = $this->Admin->addAdvert($data);
				if(!$res['state']) {
					echo exit(json_encode(array('state'=>false,'msg'=>'新增广告位失败'.$res['msg'],'data'=>'')));
				}
			    $this->System->logAction('新增广告位名:'. $ap_name, __METHOD__); 
				echo exit(json_encode(array('state'=>true,'msg'=>'操作成功','data'=>'')));
			}
		}else{
			$ap_id=isset($_GET['ap_id']) && !empty($_GET['ap_id']) ? $_GET['ap_id'] : "";
			if(!empty($ap_id)){
				$key="a.*";
				$where ="a.ap_id =".$ap_id; 
				$res=$this->Admin->getByAdvert($where,$key);
				if(!$res['state']){
					echo "获取数据失败";
				} 
				$this->smarty->assign("advert",$res['data']);
			}  
			$this->smarty->display('advertInfo.html');
		}
	}
	/**
	 * 编辑启用禁用
	 * @return：true 操作成功  false 操作失败 
	 * @author:Mr zhang
	 **/
	public function advert_isuse()
	{
		$this->System->isPriv("advert");
		$this->load->model('Admin');
		if($_POST){
			$ap_id=isset($_POST['ap_id']) ? $_POST['ap_id'] : '';
			$is_use=isset($_POST['is_use']) && !empty($_POST['is_use']) ? 0 : 1;
			$data=array('is_use'=>$is_use);
			$where="ap_id = '$ap_id'";
			$res=$this->Admin->editAdvert($data,$where);
			if(!$res['state']){
				echo exit(json_encode(array('state'=>false,'msg'=>'系统错误，数据更新失败：'.$res['msg'],'data'=>'')));
			}
			if($is_use == 0){
				$msg="禁用广告ID号为：";
			}else{
				$msg="启用广告ID号为：";
			}
			$this->System->logAction($msg. $ap_id, __METHOD__); 
			echo exit(json_encode(array('state'=>true,'msg'=>'操作成功','data'=>'')));
		}
	}
	/**
	 * 删除广告位数据
	 * @return：true 操作成功  false 操作失败 
	 * @author:Mr zhang
	 **/
	public function advert_del()
	{
		$this->System->isPriv("advert");
		$this->load->model('Admin');
		$ap_id=isset($_GET['ap_id']) ? $_GET['ap_id'] : '';
		if(empty($ap_id)){
			echo exit(json_encode(array('state'=>false,'msg'=>'请选择要操作的数据项','data'=>'')));
		}
		$res=$this->Admin->getByAdvert("d.ap_id ='$ap_id'","is_use,d.ap_id");
		if(!$res['state']){
			echo exit(json_encode(array('state'=>false,'msg'=>'系统错误，获取数据失败：'.$res['msg'],'data'=>'')));
		}
		if($res['data']['is_use'] == 1){
			echo exit(json_encode(array('state'=>false,'msg'=>'状态已启用,若要删除，请先禁用','data'=>'')));
		}
		if(!empty($res['data']['ap_id'])){
			echo exit(json_encode(array('state'=>false,'msg'=>'该广告位下存在广告，请先删除该广告位下的广告在删除广告位','data'=>'')));
		}
		$res=$this->Admin->delAdvert("ap_id IN ($ap_id)");
		if(!$res['state']){
			echo exit(json_encode(array('state'=>false,'msg'=>'系统错误，数据操作失败：'.$res['msg'],'data'=>'')));
		}
		$this->System->logAction('删除广告位数据ID号为：'. $ap_id, __METHOD__); 
		echo exit(json_encode(array('state'=>true,'msg'=>'删除成功','data'=>'')));
	} 

	/**
	 * 广告展示列 
	 * @author:Mr zhang
	 **/
	public function advertDetails(){
		$this->System->isPriv("advert");
		$this->load->model('Admin');
		date_default_timezone_set('PRC');
		if($_POST){
			$page=isset($_POST["start"]) ? $_POST["start"]:0;
	    	$rp  =isset($_POST["length"]) ? $_POST["length"]:50;
	    	$ap_id =isset($_POST["ap_id"]) ? $_POST["ap_id"] : ""; 
	    	//后台排序
	    	$orderArr = isset($_POST['order']) ? $_POST['order'] : '';
	    	$sortType = "desc";
            $sortName = "d.adv_id"; 
            if(!empty($orderArr)){ 
                if(!isset($orderArr[1])){ 
                    $sortType = $orderArr[0]['dir'];
                    switch ($orderArr[0]['column']){
                        case '1':
                            $sortName = "adv_id";
                            break;
                        case '2':
                            $sortName = "adv_title";
                            break; 
                        case '3':
                            $sortName = "adv_content";
                            break;
                        case '4':
                            $sortName = "adv_start_date";
                            break; 
                        case '5':
                            $sortName = "adv_end_date";
                            break;
                        case '6':
                            $sortName = "slide_sort";
                            break;
                        default:
                            $sortName = "adv_id";
                    }
                } 
            }
            $where ="d.ap_id=".$ap_id;
            $key ="d.*,a.ap_name";
            $order_by=$sortName.' '.$sortType;
            $limit=array('limit'=>true,'curpage'=>$page,'rp'=>$rp);
            $res=$this->Admin->getAllAdvertPosition($where,$key,$order_by,$limit);
	    	if(!$res['state']){
	    		echo exit(json_encode(array('state'=>false,'msg'=>'获取数据失败'.$res['msg'],'data'=>'')));
	    	} 
	        if(empty($res['data']['datas'])){
	            $datas=array(
	              "sEcho"=>$this->input->get('sEcho',true),
	              "iTotalDisplayRecords"=>0,
	              "iTotalRecords"=>0,
	              "aaData"=>array()
	            );
	            echo exit(json_encode($datas));die;
	        }
	        $list=$res['data']['datas'];
	        foreach ($res['data']['datas'] as $key => $value) {
	        	$list[$key]['adv_start_date']=date("Y-m-d H:i:s",$value['adv_start_date']);
	        	$list[$key]['adv_end_date']=date("Y-m-d H:i:s",$value['adv_end_date']);
	        }
            $datas=array(
              "sEcho"=>$this->input->get('sEcho',true),
              "iTotalDisplayRecords"=>intval($res['data']['count']),
              "iTotalRecords"=>intval($res['data']['count']),
              "aaData"=>$list
            );
            echo exit(json_encode($datas));
		}else{
			$ap_id=isset($_GET['ap_id'])?$_GET['ap_id']:"";
			$ap_class=isset($_GET['ap_class'])?$_GET['ap_class']:"";
			$ap_name=isset($_GET['ap_name'])?$_GET['ap_name']:"";
			$this->smarty->assign("ap_id",$ap_id);
			$this->smarty->assign("ap_class",$ap_class);
			$this->smarty->assign("ap_name",$ap_name);
			$this->smarty->display('advertDetails.html');
		}
	} 
	/**
	 * 编辑/新增广告数据
	 * @return：true 操作成功  false 操作失败 
	 * @author:Mr zhang
	 **/
	public function advertDetails_edit(){
		$this->System->isPriv("advertDetails");
		$this->load->model('Admin');

		if($_POST || $_FILES){
			$adv_id =isset($_POST['adv_id']) && !empty($_POST['adv_id']) ? $_POST['adv_id'] :""; 
			$ap_id =isset($_POST['ap_id']) && !empty($_POST['ap_id']) ? $_POST['ap_id'] :""; 
			$ap_class =isset($_POST['ap_class']) ? $_POST['ap_class'] :""; //广告类型
			$adv_title =isset($_POST['adv_title']) && !empty($_POST['adv_title']) ? trim($_POST['adv_title']):"";//广告标题
			$adv_desc =isset($_POST['adv_desc']) && !empty($_POST['adv_desc']) ? trim($_POST['adv_desc']):"";//广告描述
			$adv_link =isset($_POST['adv_link']) && !empty($_POST['adv_link']) ? trim($_POST['adv_link']):"";//广告链接
			$adv_start_date =isset($_POST['adv_start_date']) && !empty($_POST['adv_start_date']) ? strtotime(trim($_POST['adv_start_date'])." 00:00:00"):"";//广告开始时间
			$adv_end_date =isset($_POST['adv_end_date']) && !empty($_POST['adv_end_date']) ? strtotime(trim($_POST['adv_end_date'])." 23:59:59") :0;//广告结束时间
			$slide_sort =isset($_POST['slide_sort']) ? trim($_POST['slide_sort']) :"";//排序
			$adv_content =isset($_POST['adv_content'])  && !empty($_POST['adv_content']) ? trim($_POST['adv_content']) :"";//广告内容 
			if(empty($adv_title)){
				echo exit(json_encode(array('state'=>false,'msg'=>'广告名称不能为空','data'=>'')));
			}
			if(empty($adv_start_date)){
				echo exit(json_encode(array('state'=>false,'msg'=>'广告开始时间不能为空','data'=>'')));
			}
			if(empty($adv_end_date)){
				echo exit(json_encode(array('state'=>false,'msg'=>'广告结束时间不能为空','data'=>'')));
			} 
			if($adv_end_date<$adv_start_date){
				echo exit(json_encode(array('state'=>false,'msg'=>'广告结束时间必须大于广告开始时间','data'=>'')));
			} 
			$this->db->trans_begin(); 
			if($ap_class != 1){
				if(!empty($_FILES['file'])){ 
					$file_name=isset($_FILES['file']['name'])?$_FILES['file']['name']:'';//图片名
					$file_tmpname=isset($_FILES['file']['tmp_name'])?$_FILES['file']['tmp_name']:'';//上传临时文件名 
					$file_size=isset($_FILES['file']['size'])?$_FILES['file']['size']:'';//上传临时文件大小
					$error=isset($_FILES['file']['error'])?$_FILES['file']['error']:'';//上传错误信息
			        if(!empty($error)){
						echo json_encode(array('state'=>false,'msg'=>'上传图片错误信息:'.$error,'data'=>''));exit;  
					}
					$file_type=trim(strrchr($file_name, '.'),'.'); 
			        $file_type=strtolower($file_type);
			        if($ap_class == '0'){
			        	if($file_type !='png' && $file_type !='jpg' && $file_type !='jpeg'  && $file_type !='bmp' ){
				        	echo exit(json_encode(array('state'=>false,'msg'=>'请上传png|jpg|jpeg|bmp格式图片','data'=>'')));
				        }
			        }elseif ($ap_class == '3') {
			        	if($file_type !='fla' && $file_type !='swf'){
				        	echo exit(json_encode(array('state'=>false,'msg'=>'请上传fla|swf类FLASH','data'=>'')));
				        }
			        } 
			        //判断文件夹是否存在 不存在则创建
					$dir="data/advert/";
					if(!is_dir($dir) ){
		            	mkdir($dir,0777);
		            } 
				}
				$data = array(
					'ap_id' => $ap_id,
					'adv_title' => $adv_title,
					'adv_desc' => $adv_desc, 
					'adv_link'=>$adv_link, 
					'adv_start_date'=>$adv_start_date, 
					'adv_end_date'=>$adv_end_date, 
					'slide_sort' => $slide_sort
				);
			}else{
				$data = array(
					'ap_id' => $ap_id,
					'adv_title' => $adv_title,
					'adv_desc' => $adv_desc, 
					'adv_link'=>$adv_link,
					'adv_content' => $adv_content,
					'adv_start_date'=>$adv_start_date, 
					'adv_end_date'=>$adv_end_date, 
					'slide_sort' => $slide_sort
				);
			} 
			if(!empty($adv_id)){//编辑 
				$res = $this->Admin->editAdvertDetails($data,"adv_id=".$adv_id);
				if(!$res['state']) {
					$this->db->trans_rollback();
					echo exit(json_encode(array('state'=>false,'msg'=>'编辑广告失败'.$res['msg'],'data'=>'')));
				}
				if($ap_class != 1){
					if(!empty($_FILES['file'])){
						$res=$this->Admin->getByAdvert("adv_id =".$adv_id,"adv_content");
						if(!$res['state']){
							$this->db->trans_rollback();
							echo exit(json_encode(array('state'=>false,'msg'=>'系统错误，获取单条数据失败：'.$res['msg'],'data'=>'')));
						} 
						if(!empty($res['data']['adv_content'])){
							$is_files=ROOTPATH.$res['data']['adv_content']; 
							if(file_exists($is_files))
							{
							    if (!unlink($is_files)){
							    	$this->db->trans_rollback();
							    	echo exit(json_encode(array('state'=>false,'msg'=>'删除原有文件失败'.$is_files,'data'=>'')));
							    }
							}
						} 
						$pic ='advert_'.$adv_id.'.'.$file_type;
			            $pic_path =$dir. $pic; 
			            if(!move_uploaded_file($_FILES['file']['tmp_name'],$pic_path)){
			            	$this->db->trans_rollback();
							echo exit(json_encode(array('state'=>false,'msg'=>'文件上传失败','data'=>'')));  
						} 
						$datas = array( 
							'adv_content' => $pic_path
						);
						$res = $this->Admin->editAdvertDetails($datas,"adv_id=".$adv_id); 
						if(!$res['state']) {
							$this->db->trans_rollback();
							echo exit(json_encode(array('state'=>false,'msg'=>'编辑文件失败'.$res['msg'],'data'=>'')));
						} 
					}
				} 
				$this->db->trans_commit();//提交事务
			    $this->System->logAction('编辑广告ID号:'.$adv_id .'，广告名:'. $adv_title, __METHOD__);
				echo exit(json_encode(array('state'=>true,'msg'=>'操作成功','data'=>'')));
			}else{ //新增
				$res = $this->Admin->addAdvertDetails($data);
				$add_id=$res['data'];
				if(!$res['state']) {
					$this->db->trans_rollback();
					echo exit(json_encode(array('state'=>false,'msg'=>'新增广告失败'.$res['msg'],'data'=>'')));
				}
				if($ap_class != 1){
					if(!empty($_FILES['file'])){ 
						$pic ='advert_'.$add_id.'.'.$file_type;
			            $pic_path =$dir.$pic;
			            if(!move_uploaded_file($_FILES['file']['tmp_name'],$pic_path)){
			            	$this->db->trans_rollback();
							echo exit(json_encode(array('state'=>false,'msg'=>'文件上传失败','data'=>'')));  
						}
						$datas = array( 
							'adv_content' => $pic_path
						);
						$res = $this->Admin->editAdvertDetails($datas,"adv_id=".$add_id);
						if(!$res['state']) {
							$this->db->trans_rollback();
							echo exit(json_encode(array('state'=>false,'msg'=>'编辑文件失败'.$res['msg'],'data'=>'')));
						} 
					}
				} 
				$this->db->trans_commit();//提交事务
			    $this->System->logAction('新增广告ID为：'.$add_id.'广告名:'. $adv_title, __METHOD__); 
				echo exit(json_encode(array('state'=>true,'msg'=>'操作成功','data'=>'')));
			}
		}else{
			$ap_id=isset($_GET['ap_id']) && !empty($_GET['ap_id']) ? $_GET['ap_id'] : ""; //父类id
			$ap_class=isset($_GET['ap_class']) ? $_GET['ap_class'] : ""; //类型
			$ap_name=isset($_GET['ap_name']) && !empty($_GET['ap_name']) ? $_GET['ap_name'] : ""; //广告名称
			$adv_id=isset($_GET['adv_id']) && !empty($_GET['adv_id']) ? $_GET['adv_id'] : ""; 
			if(!empty($adv_id)){
				$key="d.*,a.ap_name";
				$where ="adv_id =".$adv_id; 
				$res=$this->Admin->getByAdvert($where,$key);
				if(!$res['state']){
					echo "获取数据失败";
				}
				$res['data']['adv_start_date']=date("Y-m-d",$res['data']['adv_start_date']);
				$res['data']['adv_end_date']=date("Y-m-d",$res['data']['adv_end_date']);
				$this->smarty->assign("advertDetails",$res['data']);
			}  
			$this->smarty->assign("ap_id",$ap_id);
			$this->smarty->assign("ap_class",$ap_class);
			$this->smarty->assign("ap_name",$ap_name);
			$this->smarty->display('advertDetailsInfo.html');
		}
	}
	/**
	 * 删除广告
	 * @return：true 操作成功  false 操作失败 
	 * @author:Mr zhang
	 **/
	public function advertDetails_del()
	{
		$this->System->isPriv("advertDetails");
		$this->load->model('Admin');
		$adv_id=isset($_GET['adv_id']) ? $_GET['adv_id'] : '';
		if(empty($adv_id)){
			echo exit(json_encode(array('state'=>false,'msg'=>'请选择要操作的数据项','data'=>'')));
		} 
		$this->db->trans_begin(); 
		$res=$this->Admin->getByAdvert("adv_id =".$adv_id,"adv_content,ap_class");
		if(!$res['state']){
			$this->db->trans_rollback();
			echo exit(json_encode(array('state'=>false,'msg'=>'系统错误，获取单条数据失败：'.$res['msg'],'data'=>'')));
		} 
		if($res['data']['ap_class'] !='1' && !empty($res['data']['adv_content'])){
			$is_files=ROOTPATH.$res['data']['adv_content'];
			if(file_exists($is_files))
			{
			    if (!unlink($is_files)){
			    	$this->db->trans_rollback();
			    	echo exit(json_encode(array('state'=>false,'msg'=>'删除原有文件失败'.$is_files,'data'=>'')));
			    }
			}
		} 
		$res=$this->Admin->delAdvertDetails("adv_id IN ($adv_id)");
		if(!$res['state']){
			$this->db->trans_rollback();
			echo exit(json_encode(array('state'=>false,'msg'=>'系统错误，数据操作失败：'.$res['msg'],'data'=>'')));
		}
		$this->db->trans_commit();
		$this->System->logAction('删除广告数据ID号为：'. $adv_id, __METHOD__); 
		echo exit(json_encode(array('state'=>true,'msg'=>'删除成功','data'=>'')));
	} 
	/**
	* 意见与反馈
	* @return：true 操作成功  false 操作失败 
	* @author:Mr zhang
	**/
	public function proposal(){
		$this->System->isPriv("proposal");
		$this->load->model('Admin');
		if($_POST){
			$page=isset($_POST["start"]) ? $_POST["start"]:0;
	    	$rp  =isset($_POST["length"]) ? $_POST["length"]:50;
	    	//后台排序
	    	$orderArr = isset($_POST['order']) ? $_POST['order'] : '';
	    	$sortType = "desc";
            $sortName = "ppid"; 
            if(!empty($orderArr)){ 
                if(!isset($orderArr[1])){ 
                    $sortType = $orderArr[0]['dir'];
                    switch ($orderArr[0]['column']){
                        case '1':
                            $sortName = "name";
                            break;
                        case '2':
                            $sortName = "email";
                            break; 
                        case '3':
                            $sortName = "submit_time";
                            break;
                        case '4':
                            $sortName = "is_deal";
                            break; 
                        case '5':
                            $sortName = "p.admin_id";
                            break;
                        case '6':
                            $sortName = "sure_time";
                            break;
                        default:
                            $sortName = "ppid";
                    }
                } 
            }
            $where ="1=1";
            $key ="p.*,a.admin_name";
            $order_by=$sortName.' '.$sortType;
            $limit=array('limit'=>true,'curpage'=>$page,'rp'=>$rp);
            $res=$this->Admin->getAllProposal($where,$key,$order_by,$limit);
	    	if(!$res['state']){
	    		echo exit(json_encode(array('state'=>false,'msg'=>'获取数据失败'.$res['msg'],'data'=>'')));
	    	} 
	        if(empty($res['data']['datas'])){
	            $datas=array(
	              "sEcho"=>$this->input->get('sEcho',true),
	              "iTotalDisplayRecords"=>0,
	              "iTotalRecords"=>0,
	              "aaData"=>array()
	            );
	            echo exit(json_encode($datas));die;
	        }
	        $list=$res['data']['datas'];
	        foreach ($res['data']['datas'] as $key => $value) {
	        	$list[$key]['submit_time']=!empty($value['submit_time']) ? date("Y-m-d H:i:s",$value['submit_time']) : "";
	        	$list[$key]['sure_time']=!empty($value['sure_time']) ? date("Y-m-d H:i:s",$value['sure_time']) : "";
	        }
            $datas=array(
              "sEcho"=>$this->input->get('sEcho',true),
              "iTotalDisplayRecords"=>intval($res['data']['count']),
              "iTotalRecords"=>intval($res['data']['count']),
              "aaData"=>$list
            );
            echo exit(json_encode($datas));
		}else{
			$this->smarty->display('proposal.html');
		} 
	}

	/**
	 * 审核意见与反馈
	 * @return：true 操作成功  false 操作失败 
	 * @author:Mr zhang
	 **/
	public function proposal_isdeal()
	{
		$this->System->isPriv("proposal");
		$this->load->model('Admin');
		if($_POST){
			$ppid=isset($_POST['ppid']) ? $_POST['ppid'] : ''; 
			$data=array('is_deal'=>1,'admin_id'=>$_SESSION['admin_id'],'sure_time'=>time());
			$where="ppid = '$ppid'";
			$res=$this->Admin->editProposal($data,$where);
			if(!$res['state']){
				echo exit(json_encode(array('state'=>false,'msg'=>'系统错误，数据更新失败：'.$res['msg'],'data'=>'')));
			} 
			$this->System->logAction('后台管理员ID为：'.$_SESSION['admin_id'].'，审核意见与反馈ID为'. $ppid, __METHOD__);
			echo exit(json_encode(array('state'=>true,'msg'=>'操作成功','data'=>'')));
		}
	}
    /**
	 * 发送邮件
	 * @param  string $theme 发送邮件主题  reject拒绝 accept
	 * @param  string $email 发送邮件
	 * @param  string $projectName 发送项目
	 * @return：true 操作成功  false 操作失败 
	 * @author:Leeyoung
	 **/
	public function sendBountyEmail($theme,$email,$projectName)
	{
		$url="";
		//var_dump($projectName.$email.$theme);
		if($theme=="reject")
		{
           $url="https://ont.io/api/v1/ont/email/send4cms/bounty_reject/";
		}
		else if($theme=="accept")
	    {
            $url="https://ont.io/api/v1/ont/email/send4cms/bounty_accept/";
		}
		else
		{
			return array('state'=>false,'msg'=>'不知道的发送主题','data'=>'');
		}
		if(empty($email))
		{
			return array('state'=>false,'msg'=>'请填写邮箱','data'=>'');
		}
		if(empty($projectName))
		{
			return array('state'=>false,'msg'=>'请填写项目主题','data'=>'');
		}
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url.$email.'/'.str_replace(" ","_",$projectName));
		curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);  // 跳过检查
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);  // 跳过检查
		$res = curl_exec($curl); 
		curl_close($curl);
		$res = (array) json_decode($res,true);

        if(isset($res['Error']))
        {
        	if($res['Error']=='0')
			{
				return array('state'=>true,'msg'=>$res['Desc'],'data'=>$res);
			}
			else
			{
				return array('state'=>false,'msg'=>$res['Desc'],'data'=>$res);
			}
        }
        else
        {
        	return array('state'=>false,'msg'=>'邮件发送接口异常','data'=>$res);
        }
		
	}
	/**
	 * 审核意见与反馈详情
	 * @return：true 操作成功  false 操作失败 
	 * @author:Mr zhang
	 **/
	public function proposal_details()
	{
		$this->System->isPriv("proposal");
		$this->load->model('Admin');
		$ppid=isset($_GET['ppid']) ? $_GET['ppid'] :"";
	 	$where ="ppid =".$ppid;
        $key ="p.*,a.admin_name";
        $order_by="";
        $limit=array('limit'=>false,'curpage'=>1,'rp'=>50);
        $res=$this->Admin->getAllProposal($where,$key,$order_by,$limit);
    	if(!$res['state']){
    		echo '获取数据失败'.$res['msg'];die;
    	}
    	$list=$res['data']['datas'][0];
    	$list['submit_time']=!empty($res['data']['datas'][0]['submit_time']) ? date("Y-m-d H:i:s",$res['data']['datas'][0]['submit_time']) : "";
    	$list['sure_time']=!empty($res['data']['datas'][0]['sure_time']) ? date("Y-m-d H:i:s",$res['data']['datas'][0]['sure_time']) : "";
    	$this->smarty->assign("proposalInfo",$list);
    	$this->smarty->display("proposalDetails.html");
	}

	/**
	 * bounty建议
	 * @return：true 操作成功  false 操作失败 
	 * @author:Mr zhang
	 **/
	public function bounty()
	{
		$this->System->isPriv("bounty");
		if($_POST){
			$this->load->model('Admin'); 
			$page=isset($_POST["start"]) ? $_POST["start"]:0;
	    	$rp  =isset($_POST["length"]) ? $_POST["length"]:50;
	    	//后台排序
	    	$orderArr = isset($_POST['order']) ? $_POST['order'] : '';
	    	$sortType = "desc";
            $sortName = "cmid"; 
            if(!empty($orderArr)){ 
                if(!isset($orderArr[1])){ 
                    $sortType = $orderArr[0]['dir'];
                    switch ($orderArr[0]['column']){
                        case '1':
                            $sortName = "name";
                            break;
                        case '2':
                            $sortName = "email";
                            break; 
                        case '3':
                            $sortName = "programming_languages";
                            break;  
                        case '4':
                            $sortName = "estimated_time";
                            break;
                        case '5':
                            $sortName = "submit_time";
                            break; 
                        case '6':
                            $sortName = "is_deal";
                            break;
                        case '7':
                            $sortName = "b.admin_id";
                            break;
                        case '8':
                            $sortName = "sure_time"; 
                            break;
                        default:
                            $sortName = "cmid";
                    }
                } 
            }
            $where ="1=1";
            $key ="b.*,a.admin_name";
            $order_by=$sortName.' '.$sortType;
            $limit=array('limit'=>true,'curpage'=>$page,'rp'=>$rp);
            $res=$this->Admin->getAllBounty($where,$key,$order_by,$limit);
	    	if(!$res['state']){
	    		echo exit(json_encode(array('state'=>false,'msg'=>'获取数据失败'.$res['msg'],'data'=>'')));
	    	} 
	        if(empty($res['data']['datas'])){
	            $datas=array(
	              "sEcho"=>$this->input->get('sEcho',true),
	              "iTotalDisplayRecords"=>0,
	              "iTotalRecords"=>0,
	              "aaData"=>array()
	            );
	            echo exit(json_encode($datas));die;
	        }
	        $list=$res['data']['datas'];
	        foreach ($res['data']['datas'] as $key => $value) {
	        	$list[$key]['submit_time']=!empty($value['submit_time']) ? date("Y-m-d H:i:s",$value['submit_time']) : "";
	        	$list[$key]['sure_time']=!empty($value['sure_time']) ? date("Y-m-d H:i:s",$value['sure_time']) : "";
	        }
            $datas=array(
              "sEcho"=>$this->input->get('sEcho',true),
              "iTotalDisplayRecords"=>intval($res['data']['count']),
              "iTotalRecords"=>intval($res['data']['count']),
              "aaData"=>$list
            );
            echo exit(json_encode($datas));
		}else{
			$this->smarty->display('bountyproposal.html');
		}
	}

	/**
	 * bounty建议审核
	 * @return：true 操作成功  false 操作失败 
	 * @author:Mr zhang
	 **/
	public function bounty_isdeal()
	{
		$this->System->isPriv("bounty");
		$this->load->model('Admin');
		if($_POST){
			$cmid=isset($_POST['cmid']) ? $_POST['cmid'] : '';
			if(!is_numeric($cmid)){
				show_error("请传入正确的ID");die;
			}
			$data=array('is_deal'=>1,'admin_id'=>$_SESSION['admin_id'],'sure_time'=>time());
			$where="cmid = '$cmid'";
			$res=$this->Admin->editBounty($data,$where);
			if(!$res['state']){
				echo exit(json_encode(array('state'=>false,'msg'=>'系统错误，数据更新失败：'.$res['msg'],'data'=>'')));
			} 
			$this->System->logAction('后台管理员ID为：'.$_SESSION['admin_id'].'，审核bounty建议ID为'. $cmid, __METHOD__); 
			echo exit(json_encode(array('state'=>true,'msg'=>'操作成功','data'=>'')));
		}
	}

	/**
	 * bounty建议详情
	 * @return：true 操作成功  false 操作失败 
	 * @author:Mr zhang
	 **/
	public function bounty_details()
	{
		$this->System->isPriv("bounty");
		$this->load->model('Admin');
		$cmid=isset($_GET['cmid']) ? $_GET['cmid'] :"";
	 	$where ="cmid ='$cmid'";
        $key ="b.*,a.admin_name"; 
        $res=$this->Admin->getAllBounty($where,$key);
    	if(!$res['state']){
    		echo '获取数据失败'.$res['msg'];die;
    	}
    	$list=$res['data']['datas'][0];
    	$list['submit_time']=!empty($res['data']['datas'][0]['submit_time']) ? date("Y-m-d H:i:s",$res['data']['datas'][0]['submit_time']) : "";
    	$list['sure_time']=!empty($res['data']['datas'][0]['sure_time']) ? date("Y-m-d H:i:s",$res['data']['datas'][0]['sure_time']) : "";
    	$this->smarty->assign("bountyInfo",$list);
    	$this->smarty->display("bountyproposalDetails.html");
	}

	/**
	 * ontong应用
	 * @return：true 操作成功  false 操作失败 
	 * @author:Mr zhang
	 **/
	public function ontong()
	{
		$this->System->isPriv("ontong");
		if($_POST){
			$this->load->model('Admin'); 
			$page=isset($_POST["start"]) ? $_POST["start"]:0;
	    	$rp  =isset($_POST["length"]) ? $_POST["length"]:50;
	    	//后台排序
	    	$orderArr = isset($_POST['order']) ? $_POST['order'] : '';
	    	$sortType = "desc";
            $sortName = "ooaid,is_deal"; 
            if(!empty($orderArr)){ 
                if(!isset($orderArr[1])){ 
                    $sortType = $orderArr[0]['dir'];
                    switch ($orderArr[0]['column']){
                        case '1':
                            $sortName = "name";
                            break;
                        case '2':
                            $sortName = "phone";
                            break; 
                        case '3':
                            $sortName = "email";
                            break;  
                        case '4':
                            $sortName = "aont";
                            break;
                        case '5':
                            $sortName = "aong";
                            break; 
                        case '6':
                            $sortName = "submit_time";
                            break;
                        case '7':
                            $sortName = "is_deal";
                            break;
                        case '8':
                            $sortName = "o.admin_id"; 
                            break;
                        case '9':
                            $sortName = "sure_time"; 
                            break;
                        default:
                            $sortName = "ooaid,is_deal";
                    }
                } 
            }
            $where ="1=1";
            $key ="o.*,a.admin_name";
            $order_by=$sortName.' '.$sortType;
            $limit=array('limit'=>true,'curpage'=>$page,'rp'=>$rp);
            $res=$this->Admin->getAllOntong($where,$key,$order_by,$limit);
	    	if(!$res['state']){
	    		echo exit(json_encode(array('state'=>false,'msg'=>'获取数据失败'.$res['msg'],'data'=>'')));
	    	} 
	        if(empty($res['data']['datas'])){
	            $datas=array(
	              "sEcho"=>$this->input->get('sEcho',true),
	              "iTotalDisplayRecords"=>0,
	              "iTotalRecords"=>0,
	              "aaData"=>array()
	            );
	            echo exit(json_encode($datas));die;
	        }
	        $list=$res['data']['datas'];
	        foreach ($res['data']['datas'] as $key => $value) {
	        	$list[$key]['submit_time']=!empty($value['submit_time']) ? date("Y-m-d H:i:s",$value['submit_time']) : "";
	        	$list[$key]['sure_time']=!empty($value['sure_time']) ? date("Y-m-d H:i:s",$value['sure_time']) : "";
	        }
            $datas=array(
              "sEcho"=>$this->input->get('sEcho',true),
              "iTotalDisplayRecords"=>intval($res['data']['count']),
              "iTotalRecords"=>intval($res['data']['count']),
              "aaData"=>$list
            );
            echo exit(json_encode($datas));
		}else{
			$this->smarty->display('ontong.html');
		}
	}
	/**
	 * ontong审核
	 * @return：true 操作成功  false 操作失败 
	 * @author:Mr zhang
	 **/
	public function ontong_isdeal()
	{
		$this->System->isPriv("ontong");
		$this->load->model('Admin');
		if($_POST){
			$ooaid=isset($_POST['ooaid']) ? $_POST['ooaid'] : '';
			if(!is_numeric($ooaid)){
				show_error("请传入正确的ID");die;
			}
			$data=array('is_deal'=>1,'admin_id'=>$_SESSION['admin_id'],'sure_time'=>time());
			$where="ooaid = '$ooaid'";
			$res=$this->Admin->editOntong($data,$where);
			if(!$res['state']){
				echo exit(json_encode(array('state'=>false,'msg'=>'系统错误，数据更新失败：'.$res['msg'],'data'=>'')));
			} 
			$this->System->logAction('后台管理员ID为：'.$_SESSION['admin_id'].'，审核ontong应用ID为'. $ooaid, __METHOD__); 
			echo exit(json_encode(array('state'=>true,'msg'=>'操作成功','data'=>'')));
		}
	}

	/**
	 * ontong详情
	 * @return：true 操作成功  false 操作失败 
	 * @author:Mr zhang
	 **/
	public function ontong_details()
	{
		date_default_timezone_set('PRC');
		$this->System->isPriv("ontong");
		$this->load->model('Admin');
		$ooaid=isset($_GET['ooaid']) ? $_GET['ooaid'] :"";
		if(!is_numeric($ooaid)){
			show_error("请传入正确的ID");die;
		}
	 	$where ="ooaid ='$ooaid'";
        $key ="o.*,a.admin_name"; 
        $res=$this->Admin->getAllOntong($where,$key);
    	if(!$res['state']){
    		show_error('系统错误，获取ontong详情数据失败'.$res['msg']);die;
    	}
    	$list=$res['data']['datas'][0];
    	$list['submit_time']=!empty($res['data']['datas'][0]['submit_time']) ? date("Y-m-d H:i:s",$res['data']['datas'][0]['submit_time']) : "";
    	$list['sure_time']=!empty($res['data']['datas'][0]['sure_time']) ? date("Y-m-d H:i:s",$res['data']['datas'][0]['sure_time']) : "";
    	$this->smarty->assign("ontongInfo",$list);
    	$this->smarty->display("ontongDetails.html");
	}  

	/**
	 * 项目申请展示列 
	 * @author:Mr zhang
	 **/
	public function claim(){
		$this->System->isPriv("claim");
		$this->load->model('Admin');
		if($_POST){
			$page=isset($_POST["start"]) ? $_POST["start"]:0;
	    	$rp  =isset($_POST["length"]) ? $_POST["length"]:50;
	    	$searchType = isset($_POST['searchType']) ? $_POST['searchType'] : '';
	    	$searchVal = isset($_POST['searchVal']) ? $_POST['searchVal'] : '';
	    	$gstime = isset($_POST['gstime']) ? trim(strtotime($_POST['gstime'].' 00:00:00')) : '';
	    	$getime = isset($_POST['getime']) ? trim(strtotime($_POST['getime'].' 23:59:59')) : '';
	    	//后台排序
	    	$orderArr = isset($_POST['order']) ? $_POST['order'] : '';
	    	$sortType = "desc";
            $sortName = "submit_time"; 
            if(!empty($orderArr)){ 
                if(!isset($orderArr[1])){ 
                    $sortType = $orderArr[0]['dir'];
                    switch ($orderArr[0]['column']){
                        case '2':
                            $sortName = "c.name";
                            break;
                        case '3':
                            $sortName = "c.email";
                            break; 
                        case '4':
                            $sortName = "github_address";
                            break;
                        case '5':
                            $sortName = "c.submit_time";
                            break; 
                        case '6':
                            $sortName = "c.estimated_time";
                            break;
                        case '7':
                            $sortName = "c.is_deal";
                            break;
                        case '8':
                            $sortName = "c.admin_id";
                            break;
                        case '9':
                            $sortName = "c.sure_time";
                            break;
                        default:
                            $sortName = "submit_time";
                    }
                } 
            }  
            $where ="1=1";
            if(!empty($searchVal)){
            	if($searchType == "project"){//项目名称
            		$where .= " and h.title like '%$searchVal%'";
            	}elseif ($searchType == "Appname") {
            		$where .= " and c.name like '%$searchVal%'";
            	}else{
            		$where .= " and c.email like '%$searchVal%'";
            	}
            }
            $where .=!empty($gstime) ? " and submit_time>='$gstime'": "";
	    	$where .=!empty($getime) ? " and submit_time<='$getime'": "";
            $key ="c.*,a.admin_name,h.title";
            $order_by=$sortName.' '.$sortType;
            $limit=array('limit'=>true,'curpage'=>$page,'rp'=>$rp);
            $res=$this->Admin->getAllClaim($where,$key,$order_by,$limit);
	    	if(!$res['state']){
	    		echo exit(json_encode(array('state'=>false,'msg'=>'获取数据失败'.$res['msg'],'data'=>'')));
	    	} 
	        if(empty($res['data']['datas'])){
	            $datas=array(
	              "sEcho"=>$this->input->get('sEcho',true),
	              "iTotalDisplayRecords"=>0,
	              "iTotalRecords"=>0,
	              "aaData"=>array()
	            );
	            echo exit(json_encode($datas));die;
	        }
	        $list=$res['data']['datas'];
	        foreach ($res['data']['datas'] as $key => $value) {
	        	$list[$key]['estimated_time']=!empty($value['estimated_time']) ? date("Y-m-d H:i:s",$value['estimated_time']) : "";//预估时间
	        	$list[$key]['submit_time']=!empty($value['submit_time']) ? date("Y-m-d H:i:s",$value['submit_time']) : "";//提交时间
	        	$list[$key]['sure_time']=!empty($value['sure_time']) ? date("Y-m-d H:i:s",$value['sure_time']) : "";//审核时间
	        }
            $datas=array(
              "sEcho"=>$this->input->get('sEcho',true),
              "iTotalDisplayRecords"=>intval($res['data']['count']),
              "iTotalRecords"=>intval($res['data']['count']),
              "aaData"=>$list
            );
            echo exit(json_encode($datas));
		}else{
			$this->smarty->display('claim.html');
		} 
	}

	/**
	 * 审核意见与反馈
	 * @return：true 操作成功  false 操作失败 
	 * @author:Mr zhang
	 **/
	public function claim_isdeal()
	{
		$this->System->isPriv("claim");
		$this->load->model('Admin');
		if($_POST){
			$cmid=isset($_POST['cmid']) ? $_POST['cmid'] : ''; 
			$type=isset($_POST['type']) ? $_POST['type'] : ''; 
			if(!is_numeric($cmid)){
				show_error("请传入正确的ID");die;
			}
			if($type=='accept')
			{
                 $data=array('is_deal'=>1,'admin_id'=>$_SESSION['admin_id'],'sure_time'=>time());
			}else if($type=='reject')
			{
                 $data=array('is_deal'=>2,'admin_id'=>$_SESSION['admin_id'],'sure_time'=>time());
			}else
			{
				echo exit(json_encode(array('state'=>false,'msg'=>'未知的操作类型','data'=>'')));
			}
			$where="cmid = '$cmid'";

		    $where ="cmid ='$cmid'";
	        $key ="h.title,c.email";
	        $limit=array('limit'=>false,'curpage'=>1,'rp'=>50);
	        $res=$this->Admin->getAllClaim($where,$key,"",$limit);
	    	if(!$res['state']){
	    		show_error('系统错误，获取项目申请数据失败'.$res['msg']);die;
	    	}
	    	$list=$res['data']['datas'][0];
	    	$this->db->trans_begin();
	    	$res=$this->Admin->editClaim($data,$where);
			if(!$res['state']){
				echo exit(json_encode(array('state'=>false,'msg'=>'系统错误，数据更新失败：'.$res['msg'],'data'=>'')));
			} 
	    	$res=$this->sendBountyEmail($type,$list['email'],$list['title']);
	    	if(!$res['state'])
	    	{
	    		$this->db->trans_rollback();
	    		echo exit(json_encode(array('state'=>false,'msg'=>'邮件发送失败：'.$res['msg'],'data'=>$res['data'])));
	    	}
			$this->db->trans_commit();
			$this->System->logAction('后台管理员ID为：'.$_SESSION['admin_id'].'，审核项目申请ID为'. $cmid, __METHOD__); 
			echo exit(json_encode(array('state'=>true,'msg'=>'操作成功','data'=>'')));
		}
	} 

	/**
	 * 详情项目申请
	 * @return：true 操作成功  false 操作失败 
	 * @author:Mr zhang
	 **/
	public function claim_details()
	{
		$this->System->isPriv("claim");
		$this->load->model('Admin');
		$cmid=isset($_GET['cmid']) ? $_GET['cmid'] :"";
		if(!is_numeric($cmid)){
			show_error("请传入正确的ID");die;
		}
	 	$where ="cmid ='$cmid'";
        $key ="c.*,a.admin_name,h.title";
        $order_by="";
        $limit=array('limit'=>false,'curpage'=>1,'rp'=>50);
        $res=$this->Admin->getAllClaim($where,$key,$order_by,$limit);
    	if(!$res['state']){
    		show_error('系统错误，获取项目申请数据失败'.$res['msg']);die;
    	}
    	$list=$res['data']['datas'][0];
    	$list['estimated_time']=!empty($res['data']['datas'][0]['estimated_time']) ? date("Y-m-d H:i:s",$res['data']['datas'][0]['estimated_time']) : "";//预估时间
    	$list['submit_time']=!empty($res['data']['datas'][0]['submit_time']) ? date("Y-m-d H:i:s",$res['data']['datas'][0]['submit_time']) : "";
    	$list['sure_time']=!empty($res['data']['datas'][0]['sure_time']) ? date("Y-m-d H:i:s",$res['data']['datas'][0]['sure_time']) : "";
    	$this->smarty->assign("claimInfo",$list);
    	$this->smarty->display("claimDetails.html");
	}
	 /**
	 * 媒体列表
	 * @return：
	 * @author:了念
	 **/
	public function media()
	{
		$this->System->isPriv("media_up");
		$this->load->model('Admin');
		if($_POST){
			$page = isset($_POST['curpage']) ? $_POST['curpage'] : 1;
			$rp = isset($_POST['rp']) ? $_POST['rp'] : 10;
			$type = isset($_POST['type']) ? $_POST['type'] : "";
			if($type == "bounty")
			{
				$where="mdfl_type=1";
				$key="*";
				$order_by="mdfl_id desc"; 
				$res=$this->Admin->getAllMedia($where,$key,$order_by);
				if(!$res['state']){
	 				echo exit(json_encode(array('state'=>false,'msg'=>'数据获取失败：'.$res['msg'],'data'=>'')));
	 			}
			}else{
				$where="1=1";
				$key="*";
				$order_by="mdfl_id desc";
				$limit=array('limit'=>true,'curpage'=>$page,'rp'=>$rp);
				$res=$this->Admin->getAllMedia($where,$key,$order_by,$limit);
				if(!$res['state']){
	 				echo exit(json_encode(array('state'=>false,'msg'=>'数据获取失败：'.$res['msg'],'data'=>'')));
	 			}
	 			$res['data']['curpage']=$page;
				$res['data']['rp']=$rp;
			}
			echo exit(json_encode(array('state'=>true,'msg'=>'获取成功','data'=>$res['data'])));
		}else{
			$this->smarty->display('mediaGallery.html');
		}
	}
	 /**
	 * 上传媒体文件 
	 * @author:了念
	 **/
	public function media_up()
    {
        $this->System->isPriv("media_up");
        $this->load->model('Admin');
        if ($_POST || $_FILES) {
            $mdfl_type = isset($_POST['mdfl_type']) && !empty($_POST['mdfl_type']) ? trim($_POST['mdfl_type']) : "";//文件类型
            $mdfl_desc = isset($_POST['mdfl_desc']) && !empty($_POST['mdfl_desc']) ? trim($_POST['mdfl_desc']) : "";//文件描述
            if (empty($mdfl_desc)) {
                echo exit(json_encode(array('state' => false, 'msg' => '2022 文件描述不能为空', 'data' => '')));
            }
            if (empty($_FILES['file'])) {
                echo exit(json_encode(array('state' => false, 'msg' => '2025 请上传文件', 'data' => '')));
            }
            $file_name = isset($_FILES['file']['name']) ? $_FILES['file']['name'] : '';//文件名
//            $file_tmpname = isset($_FILES['file']['tmp_name']) ? $_FILES['file']['tmp_name'] : '';//上传临时文件名
//            $file_size = isset($_FILES['file']['size']) ? $_FILES['file']['size'] : '';//上传临时文件大小
            $error = isset($_FILES['file']['error']) ? $_FILES['file']['error'] : '';//上传错误信息
            if (!empty($error)) {
                echo exit(json_encode(array('state' => false, 'msg' => '2032 Upload img error.' . $error, 'data' => '')));
            }
            $file_type = trim(strrchr($file_name, '.'), '.');
            $file_type = strtolower($file_type);//将大写转化为小写
            if ($mdfl_type == "1") {//上传图片
                if ($file_type != 'png' && $file_type != 'jpg' && $file_type != 'jpeg' && $file_type != 'bmp') {
                    echo exit(json_encode(array('state' => false, 'msg' => '2038 请上传png|jpg|jpeg|bmp格式图片', 'data' => '')));
                }
            } elseif ($mdfl_type == "2") {//FLASH
                if ($file_type != 'fla' && $file_type != 'swf') {
                    echo exit(json_encode(array('state' => false, 'msg' => '2042 请上传fla|swf类FLASH', 'data' => '')));
                }
            }

            //判断文件夹是否存在 不存在则创建
            $dir = "data/media/";
            if (!is_dir($dir)) {
                mkdir($dir, 0777);
            }
            $datas = array(
                'mdfl_type' => $mdfl_type,
                'mdfl_desc' => $mdfl_desc
            );
            $res = $this->Admin->addMedia($datas);
            $add_id = $res['data'];
            if (!$res['state']) {
                echo exit(json_encode(array('state' => false, 'msg' => '2058 数据写入失败：' . $res['msg'], 'data' => '')));
            }
            $pic = 'media_' . $add_id . '.' . $file_type;
            $pic_path = $dir . $pic;
            if (!move_uploaded_file($_FILES['file']['tmp_name'], $pic_path)) {
                echo exit(json_encode(array('state' => false, 'msg' => '2063 图片上传失败', 'data' => '')));
            }
            $data = array(
                'mdfl_url' => $pic_path
            );
            $res = $this->Admin->editMedia($data, "mdfl_id=" . $add_id);
            if (!$res['state']) {
                echo exit(json_encode(array('state' => false, 'msg' => '2070 编辑某体文件失败' . $res['msg'], 'data' => '')));
            }
            $this->System->logAction('新增媒体文件ID为:' . $add_id . '文件标题为:' . $mdfl_desc, __METHOD__);
            echo exit(json_encode(array('state' => true, 'msg' => '2073 操作成功', 'data' => '')));
        } else {
            $this->smarty->display('mediaUp.html');
        }
    }
	
	/**
	 * 删除连接
	 * @return：true 操作成功  false 操作失败 
	 * @author:Mr zhang
	 **/
	public function media_del()
	{
		$this->System->isPriv("media");
		$this->load->model('Admin');
		$mdfl_id=isset($_GET['mdfl_id']) ? $_GET['mdfl_id'] : '';
		if(empty($mdfl_id)){
			echo exit(json_encode(array('state'=>false,'msg'=>'请选择要操作的数据项','data'=>'')));
		}  
		$this->db->trans_begin();
		$res=$this->Admin->getByMedia("mdfl_id ='$mdfl_id'","mdfl_url");
		if(!$res['state']){
			$this->db->trans_rollback();
			echo exit(json_encode(array('state'=>false,'msg'=>'系统错误，获取单条数据失败：'.$res['msg'],'data'=>'')));
		} 
		if(!empty($res['data']['mdfl_url'])){
			$is_files=ROOTPATH.$res['data']['mdfl_url'];
			if(file_exists($is_files))
			{
			    if (!unlink($is_files)){
			    	$this->db->trans_rollback();
			    	echo exit(json_encode(array('state'=>false,'msg'=>'删除原有图片失败'.$is_files,'data'=>'')));
			    }
			} 
		}
		$res=$this->Admin->delMedia("mdfl_id IN ($mdfl_id)");
		if(!$res['state']){
			$this->db->trans_rollback();
			echo exit(json_encode(array('state'=>false,'msg'=>'系统错误，数据操作失败：'.$res['msg'],'data'=>'')));
		}
		$this->db->trans_commit();
		$this->System->logAction('删除媒体文件ID号为：'. $mdfl_id, __METHOD__); 
		echo exit(json_encode(array('state'=>true,'msg'=>'删除成功','data'=>'')));
	} 

	/**
	*方法说明：导出数据
	*@param:Mr zhang
    **/
    public function export()
    { 
    	require_once ROOTPATH . '/libraries/PHPExcel.php'; 
    	$objPHPExcel = new PHPExcel();
    	$objPHPExcel->getProperties()->setCreator('jk')
			->setLastModifiedBy('jk')
			->setTitle('Office 2007 XLSX Document')
			->setSubject('Office 2007 XLSX Document')
			->setDescription('Document for Office 2007 XLSX, generated using PHP classes.')
			->setKeywords('office 2007 openxml php')
			->setCategory('Result file'); 
		$this->load->model("Admin");
    	$tag=isset($_GET['tag']) && !empty($_GET['tag']) ? $_GET['tag'] : "";//操作类型  claim 
    	if($tag == "claim"){
	        $searchType = isset($_POST['searchType']) ? $_POST['searchType'] : '';
	    	$searchVal = isset($_POST['searchVal']) ? $_POST['searchVal'] : '';
	    	$gstime = isset($_POST['gstime']) ? trim(strtotime($_POST['gstime'].' 00:00:00')) : '';
	    	$getime = isset($_POST['getime']) ? trim(strtotime($_POST['getime'].' 23:59:59')) : ''; 
	        $where ="1=1";
	        if(!empty($searchVal)){
	        	if($searchType == "project"){//项目名称
	        		$where .= " and h.title like '%$searchVal%'";
	        	}elseif ($searchType == "Appname") {
	        		$where .= " and c.name like '%$searchVal%'";
	        	}else{
	        		$where .= " and c.email like '%$searchVal%'";
	        	}
	        }
	        $where .=!empty($gstime) ? " and submit_time>='$gstime'": "";
	    	$where .=!empty($getime) ? " and submit_time<='$getime'": "";
	        $key ="c.*,a.admin_name,h.title";
	        $order_by='submit_time desc'; 
	        $res=$this->Admin->getAllClaim($where,$key,$order_by);
			$list=$res['data']['datas'];
			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A1', '序号')
			->setCellValue('B1', '项目名称')
			->setCellValue('C1', '申请姓名')
			->setCellValue('D1', '电子邮件')
			->setCellValue('E1', 'github地址')
			->setCellValue('F1', '提交时间')
			->setCellValue('G1', '预估时间')
			->setCellValue('H1', '是否处理')
			->setCellValue('I1', '处理人')
			->setCellValue('J1', '团队描述')
			->setCellValue('K1', '计划描述');
			$i = 2;
			foreach ($list as $k => $v) {
				$is_deal=isset($v['is_deal']) && ($v['is_deal'] =='1') ? '是' : '否';
				$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A' . $i, ++$k)
					->setCellValue('B' . $i, $v['title'])
					->setCellValue('C' . $i, $v['name'])
					->setCellValue('D' . $i, $v['email'])
					->setCellValue('E' . $i, $v['github_address'])
					->setCellValue('F' . $i, date('Y-m-d H:i:s', $v['submit_time']))
					->setCellValue('G' . $i, date('Y-m-d H:i:s', $v['estimated_time']))
					->setCellValue('H' . $i, $is_deal)
					->setCellValue('I' . $i, $v['admin_name'])
					->setCellValue('J' . $i, $v['team_desc'])
					->setCellValue('K' . $i, $v['plan_desc']);
				$i++;
			}
    	}
		$objPHPExcel->getActiveSheet()->setTitle('claim');
		$objPHPExcel->setActiveSheetIndex(0);
		$filename = urlencode('项目申请') . date('YmdHis');
		ob_end_clean();
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$aaa = $objWriter->save('php://output');
        exit; 
    }
}