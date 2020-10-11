<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class System extends CI_Model{
	public function __construct()
    {
        $this->load->database();
        $this->load->language('common');
    }
	/**
    * 通过code获取system_config表中的对应值
    * @param unknown $code  code值
    */
   public function getSystemValue($code=null){
       $result=array();
       if($code)
       {
       	  $result=$this->db->select('code,value,type')->from('system_config')->where_in('code',$code)->get()->result_array();
       }
       else{
       	  $result=$this->db->select('code,value,type')->from('system_config')->get()->result_array();
       }
       $error = $this->db->error();
	    if(!empty($error['code']))
	    {
	    	return array('state' => false,'msg'=>"查询错误:".$error['code'].$error['message'],'data'=>'');
	    }
       $res=array();
       foreach($result as $k=>$v)
       {
       	   $res[$v['code']]=$v['value'];
       }
       if($result){
           return array('state'=>true,'msg'=>'it is ok','data'=>$res);
       }else{
           return array('state'=>false,'msg'=>'it is empty','data'=>$res);
       }
   }
   /**
    * 通过arr修改system_config表中的对应值
    * @param unknown $code  code值
    */
   public function updateSystemValue($where){
   	   if(isset($where['key'])&&isset($where['value']))
   	   {
   	   	 $this->db->update('system_config',array('value'=>$where['value']), array('code' =>$where['key']));
         $error = $this->db->error();
		    if(!empty($error['code']))
		    {
		    	return array('state' => false,'msg'=>"操作错误:".$error['code'].$error['message'],'data'=>'');
		    }
	        else{
	        	return array('state'=>true,'msg'=>'it is ok','data'=>'');
	        }
   	   }else
   	   {
   	   	   return array('state' => false,'msg'=>"参数不合法",'data'=>'');
   	   }
       
   }
    /**
    * 获取通知模版
    * @param tplCode  通知模版编码
    */
   public function getNoticeTpl($noticeTplCode,$underUserId){
   	     $tpl=$this->db->select('template_subject,sms_content,out_sms_templateId,is_sms_on,email_content,is_email_on,weixin_content,out_weixin_templateId,is_weixin_on')
   	      ->get_where('notice_templates',array('template_code' => $noticeTplCode,'under_user_id' => $underUserId))->row_array();
   	     if(!empty($error['code']))
	        {
	        	return array('state' => false,'msg'=>"查询错误!",'data'=>'');
	        }
	        else{
	        	return array('state' => true,'msg'=>"获取成功！",'data'=>$tpl);
	        }       	
   }
   /**
    * 获取系统权限树
    * 
    */
   public function getActionList(){
   	     $actionList=$this->db->select('action_id,action_parent_id,action_code,action_comment,action_level')->order_by('action_level,action_sort')->get('admin_action')->result_array();
   	     if(!empty($error['code']))
	     {
	        	return array('state' => false,'msg'=>"查询错误!",'data'=>'');
	      }
	      else{
	      	    $refer = array();  
			    $tree = array();  
			    foreach($actionList as $k => $v){  
			        $refer[$v['action_id']] = & $actionList[$k];  //创建主键的数组引用  
			    }  
			    foreach($actionList as $k => $v){  
			        $pid = $v['action_parent_id'];   //获取当前分类的父级id  
			        if($pid == 0){  
			            $tree[] = &$actionList[$k];   //顶级栏目
			            $tree[$k]['args']=$actionList[$k]['action_code'];
			        }else{  
			            if(isset($refer[$pid])){
			            	if($actionList[$k]['action_level']==3)
			            	{
			            		$actionList[$k]['args']=$refer[$pid]['action_code'].'/'.$actionList[$k]['action_code'];
			            	}
			            	else{
			            		$actionList[$k]['args']=$actionList[$k]['action_code'];
			            	}  
			                $refer[$pid]['list'][] = & $actionList[$k];  //如果存在父级栏目，则添加进父级栏目的子栏目数组中    
			            }  
			        }  
			    }
	        	return array('state' => true,'msg'=>"获取成功！",'data'=>$tree);
	      }       	
   }
    /**
    * 判断系统管理员对某一个操作是否有权限.
    * 根据当前对应的action_code，然后再和用户session里面的action_list做匹配，以此来决定是否可以继续执行。
    * @param string $priv_str	操作对应的priv_str
    * @param string $msg_output 是否页面提示权限认证失败
    * @return array/page/string
    * @author wl修改
    */
    public function isPriv($priv_str, $msg_output = true) {
        //检查是否登录过 如果没有直接跳入登录
        if ((!isset($_SESSION['admin_id']) || intval($_SESSION['admin_id']) <= 0))
        {
            // php 判断是否为 ajax 请求
            if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"])=="xmlhttprequest"){
                echo json_encode(array('state'=>'403','msg'=>'登录已过期请重新登录','data'=>''));die;
            }else{
                // 正常请求的处理方式
                exit('<script  language="JavaScript">top.location.href="'.base_url("admin.php/index/login").'"</script>');
                // header("location:".base_url("admin.php/index/login"));
            };
        }
        //验证权限
        if ($_SESSION ['action_list'] == 'all') {
       	    return array('state' => true,'msg'=>"权限认证通过！",'data'=>'');
        }
        if (strpos ( ",{$_SESSION ['action_list']},", ",{$priv_str}," ) === false){
            if($msg_output) { 
                if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"])=="xmlhttprequest"){
                    echo json_encode(array('state'=>false,'msg'=>'你没有此操作权限！','data'=>''));
                }else{
                    // 正常请求的处理方式
                    $this->showMessage("你没有访问此页面的权限！");
                };
            }  
            return array('state' => false,'msg'=>"权限认证不通过！",'data'=>'');
        } else {
            return array('state' => true,'msg'=>"权限认证通过！",'data'=>'');
        }
    }
    /**
    * 记录管理员的操作内容
    *
    * @access  public
    * @param   string      $url        操作的地址
    * @param   string      $content    操作的内容
    * @return  void
    */
   public function logAction($content,$url)
   {
       $data = array(
           'log_time' => time(),
           'admin_id' => $_SESSION['admin_id'],
           'log_content' => stripslashes($content),
           'ip' => real_ip(),
           'url' => $url,
           'admin_name' => $_SESSION['admin_name']
       );
       $this->db->insert('admin_log', $data);
       if(!empty($error['code']))
	    {
	       return array('state' => false,'msg'=>"记录日志失败!",'data'=>'');
	    }
	     else{
	       return array('state' => true,'msg'=>"记录成功！",'data'=>'');
	     }    
   }
     /**
     * 提交弹出框
     * @access  public
     * @param   string      $msg_detail         数据的唯一值
     * @param   string      $back     默认跳转
     * @param   string      $jump   标题
     * @param   string      $msg_type
     * @param   string      $links   指定跳转
     * @param   string      $auto_redirect   是否手动点击跳转
     * @param   string      $msg_tpl   模板
     *  * @leeyoung
     */
   public function showMessage($msg_detail,$msg_type = 0, $links = array(), $auto_redirect = true, $msg_tpl = 'message.htm') {
        $lang = $this->lang->line('system');
        if (count ( $links ) == 0) {
            $links [0] ['text'] = $lang['go_back'];
            $links [0] ['href'] = 'javascript:history.go(-1)';
        }
        $this->smarty->assign ( 'page_title', $lang['system_message'] );
        $this->smarty->assign('handle_jump', $lang['handle_jump']);
        $this->smarty->assign ( 'msg_detail', $msg_detail );
        $this->smarty->assign ( 'msg_type', $msg_type );
        $this->smarty->assign ( 'links', $links );
        $this->smarty->assign ( 'default_url', json_encode($links[0]['href']));
        $this->smarty->assign ( 'supp_url', $links[0]['href']);
        $this->smarty->assign ( 'auto_redirect', $auto_redirect );
        $this->smarty->assign ( 'errand_store', '操作提示' );
        $this->smarty->display ( $msg_tpl );
        exit ();
   }

   /**
    * 检验旧密码
    * 
    */
   public function checkoldPwd($where){
        if(is_string($where)){
            $this->db->select('admin_pwd');
            $this->db->from('admin');
            $this->db->where($where);
            $arr=$this->db->get()->row_array();
            $error=$this->db->error();
            if(!empty($error['code'])){
                return array('state'=>false,'查询错误'=>$error['code'].$error['message'],'data'=>'');exit;
            }
            return array('state'=>true,'查询成功','data'=>$arr);
        }else{
            return array('state'=>false,'msg'=>'参数错误','data'=>'');die;
        }
        
   }
   /**
    * 修改密码
    * 
    */
   public function changePwd($data,$where){
       if(is_array($data)){
         $arr=$this->db->update('admin',$data,$where);
         $error=$this->db->error();
            if(!empty($error['code'])){
                return array('state'=>false,'msg'=>'查询错误'.$error['code'].$error['message'],'data'=>'');exit;
            }
            return array('state'=>true,'msg'=>'更新成功','data'=>$arr);
        }else{
            return array('state'=>false,'msg'=>'参数传递错误','data'=>'');die;
        
       }
   }


}
