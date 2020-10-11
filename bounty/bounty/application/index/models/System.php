<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class System extends CI_Model{
	public function __construct()
    {
        $this->load->database();
        $this->load->language('common');
    }
    /**
    * 获取用户信息.
    * @param  arary $where 查询条件
    * @return 1，参数异常：返回false 查找错误;true 查询成功
    **/
    public function getBusinessInfo($where,$cols='*'){
        if(is_array($where) && is_string($cols))
        {
            $rows=$this->db->select($cols)->from('business')->where($where)->get()->row_array();
         	$error = $this->db->error();
		    if(!empty($error['code']))
		    {
		    	return array('state' => false,'msg'=>"查询错误:".$error['code'].$error['message'],'data'=>'');die;
		    }
		    return array('state' => true,'msg'=>'查询成功','data'=>$rows);
        }else{
         	return array('state' => false,'msg'=>'参数错误,需要查看键值数组','data'=>'');
        }        
    }
	/**
    * 通过code获取system_config表中的对应值
    * @param unknown $code  code值
    */
   public function getSystemValue($code){
       $result=$this->db->select('code,value,type')->from('system_config')->where_in('code',$code)->get()->result_array();
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
    * 发送验证类短信验证码
    * @param unknown $code  code值
    */
   public function sendYzmSms($noticeTplCode,$mobile,$data){
         $res=$this->getSystemValue(array('ihuiyi_sms_apiid','ihuiyi_sms_apikey'));
		 if(!$res['state'])
		 {
		 	return  array('state'=>false,'msg'=>$res['msg'],'data'=>'');
		 }
		 $this->load->library('Ihuyi', $res['data']);
		 $notice=$this->getNoticeTpl($noticeTplCode,0);
		 if(!$notice['state'])
		 {
		 	return  array('state'=>false,'msg'=>$notice['msg'],'data'=>'');
		 }
		 if(!$notice['data'])
		 {
		 	return  array('state'=>false,'msg'=>'系统设置错误,没有设置此模版','data'=>'');
		 }
		 else{
		 	if($notice['data']['state']=='0')
		 	{
		 		return  array('state'=>false,'msg'=>'系统设置,此场景不发送短信通知','data'=>'');
		 	}
		 	else{
		 	   $noticeCon=str_replace('【验证码】', $data,$notice['data']['stpl_content']);
		 	   $res=$this->ihuyi->smsSend($mobile, $noticeCon);
		 	   if($res['state'])
		 	   {
		 	   	  return  array('state'=>true,'msg'=>$res['msg'],'data'=>$noticeCon);
		 	   }
		 	   else{
		 	   	  return  array('state'=>false,'msg'=>$res['msg'],'data'=>$noticeCon);
		 	   }
		 	}
		 }
		  
		    
   }
    /**
    * 获取短信通知模版
    * @param tplCode  通知模版编码
    */
   public function getNoticeTpl($noticeTplCode,$underUserId){
   	     $tpl=$this->db->select('stpl_subject,stpl_type,stpl_content,out_tpl_id,state')
   	      ->get_where('sms_tpl',array('stpl_code' => $noticeTplCode,'business_id' => $underUserId))->row_array();
   	     if(!empty($error['code']))
	        {
	        	return array('state' => false,'msg'=>"查询错误!",'data'=>'');
	        }
	        else{
	        	return array('state' => true,'msg'=>"获取成功！",'data'=>$tpl);
	        }       	
   }
   /**
    * 获取邮件通知模版
    * @param template_code  模版代码
    */
   public function getEmailNoticeTpl($template_code,$underUserId){
         $tpl=$this->db->select('template_subject,template_content,business_id')
          ->get_where('mail_tpls',array('template_code' => $template_code,'business_id' => $underUserId))->row_array();
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
   	     $actionList=$this->db->select('action_id,action_parent_id,action_code,action_comment,action_level')->order_by('action_level,action_sort')->get('business_action')->result_array();
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
			            	if($actionList[$k]['action_level']==2)
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
    *
    * 根据当前对应的action_code，然后再和用户session里面的action_list做匹配，以此来决定是否可以继续执行。
    *
    * @param string $priv_str	操作对应的priv_str
    * @param string $msg_type 返回的类型
    * @return true/false
    *  * @lxc
    */
    public function isPriv($priv_str, $msg_output = true) {
        //检查是否登录过 如果没有直接跳入登录
        // php 判断是否为 ajax 请求
        if ((!isset($_SESSION['business_id']) || intval($_SESSION['business_id']) <= 0))
        {
           if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"])=="xmlhttprequest"){
               echo json_encode(array('state'=>'403','msg'=>'登录已过期请重新登录','data'=>''));
               exit;// ajax 请求的处理方式
               // echo '<script>window.location.href="'.base_url("index.php/index/login").'";</script>';
               // header("location:".base_url("index.php/index/login"));
           }else{
           	   echo json_encode(array('state'=>'403','msg'=>'登录已过期请重新登录','data'=>''));
               header("location:".base_url("index.php/index/login"));
               exit();// 正常请求的处理方式
           };
        }
        $where=array('business_id'=>$_SESSION['business_id']);
        $key='business_id,expiry_date';
        $res=$this->getBusinessInfo($where,$key);
        if(!$res['state'])
        {
        	return array('state' => false,'msg'=>$res['msg'],'data'=>'');
        }
        if($res['data']['expiry_date']<time()){
        	echo json_encode(array('state'=>'403','msg'=>'账户已过期','data'=>''));
            header("location:".base_url("index.php/account/time_recharge"));//过期则跳转到续费页面
            exit();
        } 
        $lang = $this->lang->line('system');
        if ($_SESSION ['action_list'] == 'all') {
          return array('state' => true,'msg'=>"权限认证成功",'data'=>'');
        } 
        if (strpos ( ",{$_SESSION ['action_list']},", ",{$priv_str}," ) === false){
	       	//$links [] = array (
              // 'text' => $lang ['go_back'],
               //'href' => 'javascript:history.back(-1)'
	        //);
            if($msg_output) { 
               //$this->showMessage( $lang ['priv_error'], 1, $links );
               $this->showMessage("权限认证失败");
            }  
            return array('state' => false,'msg'=>"权限认证失败",'data'=>'');
        } else {
            return array('state' => true,'msg'=>"权限认证成功",'data'=>'');
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
   public function logAction($content,$url,$data = "")
   {
       $data = array(
           'log_time' => time(),
           'business_id' => $_SESSION['business_id'],
           'log_content' => stripslashes($content),
           'ip' => real_ip(),
           'url' => $url,
           'is_child' => $_SESSION['is_child'],
           'business_name' => $_SESSION['business_name']
       );
       if($_SESSION['is_child']==1)
       {
       	 $data['child_id']=$_SESSION['child_id'];
       	 $data['child_name']=$_SESSION['child_name'];
       }
       $this->db->insert('business_action_log', $data);
       if(!empty($error['code']))
	    {
	       return array('state' => false,'msg'=>"记录日志失败!",'data'=>'');
	    }
	     else{
	       return array('state' => true,'msg'=>"记录成功！",'data'=>'');
	     }    
   }
     /**
     * 提交过度消息
     * @access  public
     * @param   string      $msg_detail         数据的唯一值
     * @param   string      $back     默认跳转
     * @param   string      $jump   标题
     * @param   string      $msg_type
     * @param   string      $links   指定跳转
     * @param   string      $auto_redirect   是否手动点击跳转
     * @param   string      $msg_tpl   模板
     *  * @李洋
     */
   public function showMessage($msg_detail,$links = array(), $auto_redirect = true) {
        $lang = $this->lang->line('system');
        if (count ( $links ) == 0) {
            $links [0] ['text'] = $lang['go_back'];
            $links [0] ['href'] = 'javascript:history.go(-1)';
        }
        $this->smarty->assign ( 'page_title', $lang['system_message'] );
        $this->smarty->assign('handle_jump', $lang['handle_jump']);
        $this->smarty->assign ( 'msg_detail', $msg_detail );
        $this->smarty->assign ( 'links', $links );
        $this->smarty->assign ( 'default_url', json_encode($links[0]['href']));
        $this->smarty->assign ( 'supp_url', $links[0]['href']);
        $this->smarty->assign ( 'auto_redirect', $auto_redirect );
        $this->smarty->display ('message.htm');
        exit ();
   }
    /**版本续费
    *@param: is_string $key 查询的字段
    *@param: isset $where 查询条件
    *@param: is_string $order_by 排序
    *@return:array 返回数组  
    *@author:张智
    **/
    public function getAllSysRenewal($key,$where,$order_by,$curpage=1,$rp=5)
    { 
        if(is_string($key) && isset($where) && is_numeric($curpage) && is_numeric($rp) && is_string($order_by))
        {
            $this->db->select($key);
            $this->db->from('sys_renewal');  
            $this->db->where($where);
            $db=clone($this->db);
            $count=$this->db->count_all_results();
            $this->db=$db;
            $this->db->order_by($order_by);
            $this->db->limit(($curpage-1)*$rp,0);
            $rows = $this->db->get()->result_array();   
            $error = $this->db->error();
            if(!empty($error['code']))
            {
                return array('state' => false,'msg'=>"查询错误:".$error['code'].$error['message'],'data'=>'');die;
            }
            return array('state' => true,'msg'=>'查询成功','data'=>array('count'=>$count,'datas'=>$rows));
        }
        else{
            return array('state' => false,'msg'=>'参数错误','data'=>'');
        } 
   }
   /**
     * 版本续费一条记录
     * @param  is_array $where 查询条件
     * @return 1，参数异常：返回false 2，无数据：返回null 3，正常：返回数据
     * @author：张智
     **/
    public function  getBySysRenewal($where)
    {
        if(is_array($where))
        {
            $res=$this->db->get_where('sys_renewal', $where)->row_array(); 
            $error = $this->db->error();
            if(!empty($error['code']))
            {
                return array('state' => false,'msg'=>"查询错误:".$error['code'].$error['message'],'data'=>'');die;
            }
            return array('state' => true,'msg'=>'查询成功','data'=>$res);
        }
        else{
            return array('state' => false,'msg'=>'参数错误','data'=>'');
        }
    }
           /** 
    * 方法说明：广告位
    * @param: is_string $where:查询条件 
    * @param: is_string $key:获得的字段
    * @param: is_string $order_by: 排序，
    * @param: is_array  $page:是否启用分页
    * @param: $page['curpage'] 显示起始页
    * @param: $page['rp'] 每页显示的数据
    * @return: 1，参数异常：返回false 查找错误;true 查询成功;
    * @author: MS zhang
    **/ 
    public function getAllAdvertPosition($where,$key='*',$order_by='',$page=array('limit'=>false,'curpage'=>1,'rp'=>50),$group_by="")
    {
        if(is_string($where) && is_string($key) && is_string($order_by) && is_array($page) && is_string($group_by))
        {
            $this->db->select($key);
            // $this->db->from('adv_position');
            $this->db->from('adv_position as a');
            $this->db->join('adv as d','a.ap_id=d.ap_id','left');
            $this->db->where($where);
            $this->db->group_by($group_by);
            $db=clone($this->db);
            $count=$this->db->count_all_results();
            $this->db=$db;   
            $this->db->order_by($order_by);
            if($page['limit']){
                $this->db->limit($page['rp'],$page['curpage']);
            } 
            $rows = $this->db->get()->result_array(); 
            // echo $this->db->last_query(); 
            $error = $this->db->error();
            if(!empty($error['code']))
            {
               return array('state' => false,'msg'=>"查询错误:".$error['code'].$error['message'],'data'=>'');die;
            }
            return array('state' => true,'msg'=>"查询成功",'data'=>array('count'=>$count,'datas'=>$rows));
        }else{
            return array('state'=>false,'msg'=>'参数错误','data'=>'');
        }
    }
    /**
     * 获取一条平台广告位置信息
     * @param  string where 查询的条件
     * @param  string key 查询的键
     * @return 1，参数异常：返回false 查找错误;true 查询成功
     * @author:MS zhang
     **/
    public function getByAdvert($where,$key='*'){
        if(is_string($where) && is_string($key))
        {
            $this->db->select($key); 
            $this->db->from('adv_position as a');
            $this->db->join('adv as d','a.ap_id=d.ap_id','left');
            $this->db->where($where);
            $res=$this->db->get()->row_array();
            $error = $this->db->error();
            if(!empty($error['code']))
            {
                return array('state' => false,'msg'=>"查询错误:".$error['code'].$error['message'],'data'=>'');die;
            }
            return array('state' => true,'msg'=>'查询成功','data'=>$res);
        }else{
            return array('state' => false,'msg'=>'参数错误,需要数组','data'=>'');
        }  
    } 
}
