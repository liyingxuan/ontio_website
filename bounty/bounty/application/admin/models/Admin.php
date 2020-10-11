<?php
/**
 * Admin Class
 *管理员模型类
 */
class Admin extends CI_Model {

    public function __construct()
    {
        $this->load->database();
        $this->load->language('common');
    }
    /**
     * 管理员登录.
     * @param int $level_num 若为1 获取父级下的一级子分类 若为0 获取全部分类
     * @param bool $flag     为true,循环查询他的子类（默认）,为flase,只查询父类的一级子类
     * @return 1，参数异常：返回false 2，无数据：返回null 3，正常：返回数据
     */
    public function adminLogin($account,$pwd){
    	  $where='(admin_name="'.$account.'" or admin_tel="'.$account.'") and admin_pwd="'.$pwd.'"';
          $res=$this->db->select('admin_id, admin_name,role_id,admin_is_super')->from('admin')->where($where)->get()->result_array();
          $error = $this->db->error();
		    if(!empty($error['code']))
		    {
		    	return array('state' => false,'msg'=>"查询错误:".$error['code'].$error['message'],'data'=>'');die;
		    }
		    if(empty($res))
		    {
		    	 return array('state' => false,'msg'=>'账户密码错误或账户不存在','data'=>'');
		    }
		    else{
		    	 return array('state' => true,'msg'=>'查询成功','data'=>$res[0]);
		    }
		   
	          
    }
     /**
     * 管理员登录后更新数据.
     * @param int $level_num 若为1 获取父级下的一级子分类 若为0 获取全部分类
     * @param bool $flag     为true,循环查询他的子类（默认）,为flase,只查询父类的一级子类
     * @return 1，参数异常：返回false 2，无数据：返回null 3，正常：返回数据
     */
    public function updateLogin($adminId,$pwd){
    	  $where='(admin_name="'.$account.'" or admin_tel="'.$account.'") and admin_pwd="'.$pwd.'"';
          $res=$this->db->select('admin_id, admin_name,role_id,admin_is_super')->from('admin')->where($where)->get()->result_array();
          $error = $this->db->error();
		    if(!empty($error['code']))
		    {
		    	return array('state' => false,'msg'=>"查询错误:".$error['code'].$error['message'],'data'=>'');die;
		    }
		    return array('state' => true,'msg'=>'查询成功','data'=>$res[0]);
	          
    }
     /**
     * 获取角色权限.
     * @param  string $role_id 查询角色ID号
     * @return 1，参数异常：返回false 查找错误;true 查询成功
     * @author wl 修改->返回值之坑  $userinfo改为$roleinfo
     */
    public function getAdminPri($roleId){
         if(is_int($roleId))
         {
         	$where['role_id']=$roleId;
         	$roleinfo=$this->db->get_where('admin_role', $where)->row_array();
         	$error = $this->db->error();
		    if(!empty($error['code']))
		    {
		    	return array('state' => false,'msg'=>"查询错误:".$error['code'].$error['message'],'data'=>'');die;
		    }
		    return array('state' => true,'msg'=>'查询成功','data'=>$roleinfo);
         }
         else{
         	return array('state' => false,'msg'=>'参数错误,需要查看键值数组','data'=>'');
         }  
	          
    }
    /**
     * 获取管理员操作日志.
     * @param  string $role_id 查询角色ID号
     * @return 1，参数异常：返回false 查找错误;true 查询成功
     */
    public function getAdminLog($where,$sortname,$sortorder,$curpage=1,$rp=40){
         if(is_string($where)&&is_numeric($curpage)&&is_numeric($rp))
         {
         	$this->db->select('*');
            $this->db->from('admin_log');
            $this->db->where($where);
            $db=clone($this->db);
            $count=$this->db->count_all_results();
            $this->db=$db;
            $this->db->order_by($sortname,$sortorder);
            $this->db->limit($rp,($curpage-1)*$rp);
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
     * 删除管理员操作日志.
     * @param  string $where 删除的条件
     * @return 1，参数异常：返回false 查找错误;true 查询成功
     */
    public function delAdminLog($where){
         if(is_string($where))
         {
         	$this->db->where($where);
            $re = $this->db->delete('admin_log');  
         	$error = $this->db->error();
		    if(!empty($error['code']))
		    {
		    	return array('state' => false,'msg'=>"查询错误:".$error['code'].$error['message'],'data'=>'');die;
		    }
		    return array('state' => true,'msg'=>'查询成功','data'=>'');
         }
         else{
         	return array('state' => false,'msg'=>'参数错误','data'=>'');
         }  
	          
    }
     /**
     * 查询管理员
     * @param  string $where 删除的条件
     * @return 1，参数异常：返回false 查找错误;true 查询成功
     */
    public function getAdmin($where='1=1',$sortname='admin_id',$sortorder='asc',$curpage=1,$rp=40){
         if(is_string($where)&&is_numeric($curpage)&&is_numeric($rp))
         {
            $this->db->select('a.*, r.role_name');
            $this->db->from('admin as a');
            $this->db->join('admin_role as r','a.role_id = r.role_id','left');
            $this->db->where($where);
            $db=clone($this->db);
            $count=$this->db->count_all_results();
            $this->db=$db;
            $this->db->order_by($sortname,$sortorder);
            $this->db->limit(($curpage-1)*$rp,$rp);
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
     * 添加管理员
     * @param  string $where 删除的条件
     * @return 1，参数异常：返回false 查找错误;true 查询成功
     */
    public function addAdmin($data){
         if(is_array($data))
         {
            $res = $this->db->insert('admin',$data);
         	$error = $this->db->error();
		    if(!empty($error['code']))
		    {
		    	return array('state' => false,'msg'=>"执行错误:".$error['code'].$error['message'],'data'=>'');die;
		    }
		    return array('state' => true,'msg'=>'执行成功','data'=>'');
         }
         else{
         	return array('state' => false,'msg'=>'参数错误','data'=>'');
         }  
	          
    } /**
     * 编辑管理员
     * @param  string $where 删除的条件
     * @return 1，参数异常：返回false 查找错误;true 查询成功
     */
    public function editAdmin($data,$where){
         if(is_array($data))
         {
            $res = $this->db->update('admin', $data, $where);;
         	$error = $this->db->error();
		    if(!empty($error['code']))
		    {
		    	return array('state' => false,'msg'=>"执行错误:".$error['code'].$error['message'],'data'=>'');die;
		    }
		    return array('state' => true,'msg'=>'执行成功','data'=>'');
         }
         else{
         	return array('state' => false,'msg'=>'参数错误','data'=>'');
         }  
	          
    }
     /**
     * 删除管理员
     * @param  string $where 删除的条件
     * @return 1，参数异常：返回false 查找错误;true 查询成功
     */
    public function delAdmin($admin_id){
         if(is_numeric($admin_id))
         {
            $this->db->where('admin_id',$admin_id);
	        $this->db->delete('admin');
         	$error = $this->db->error();
		    if(!empty($error['code']))
		    {
		    	return array('state' => false,'msg'=>"执行错误:".$error['code'].$error['message'],'data'=>'');die;
		    }
		    return array('state' => true,'msg'=>'执行成功','data'=>'');
         }
         else{
         	return array('state' => false,'msg'=>'参数错误','data'=>'');
         }  
	          
    }
     /**
     * 查询管理员角色
     * @param  string $where 删除的条件
     * @return 1，参数异常：返回false 查找错误;true 查询成功
     */
    public function getRoles($where,$sortname='role_id',$sortorder='asc',$curpage=1,$rp=40){
         if(is_string($where) && is_numeric($curpage) && is_numeric($rp)){
            $this->db->select('role_id, role_name,role_actions,role_comments');
            $this->db->from('admin_role');
            $this->db->where($where);
            $db=clone($this->db);
            $count=$this->db->count_all_results();
            $this->db=$db;
            $this->db->order_by($sortname,$sortorder);
            $this->db->limit(($curpage-1)*$rp,$rp);
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
     * 添加角色.
     * @param  array $data 角色数据数组
     * @return 1，参数异常：返回false 2，无数据：返回null 3，正常：返回数据
     */
    public function addRole($data){
       if($data)
    	  {
    	  	  $res = $this->db->insert('admin_role',$data);
              if(!empty($error['code']))
		      {
		       return array('state' => false,'msg'=>"操作错误:".$error['code'].$error['message'],'data'=>'');die;
		      }
		      return array('state' => true,'msg'=>'操作成功','data'=>'');
    	  }
    	  else{
    	  	 return array('state' => false,'msg'=>'参数类型错误','data'=>'');
    	  }          
    }
     /**
     * 编辑管理员角色
     * @param  string $where 删除的条件
     * @return 1，参数异常：返回false 查找错误;true 查询成功
     */
    public function editRole($data,$where){
          if(is_array($data))
         {
            $res = $this->db->update('admin_role', $data, $where);;
         	$error = $this->db->error();
		    if(!empty($error['code']))
		    {
		    	return array('state' => false,'msg'=>"执行错误:".$error['code'].$error['message'],'data'=>'');die;
		    }
		    return array('state' => true,'msg'=>'执行成功','data'=>'');
         }
         else{
         	return array('state' => false,'msg'=>'参数错误','data'=>'');
         }  
    }
     /**
     * 删除管理员角色
     * @param  string $where 删除的条件
     * @return 1，参数异常：返回false 查找错误;true 查询成功
     */
    public function delRole($role_id){
         if(is_numeric($role_id))
         {
         	$res=$this->getAdmin('a.role_id='.$role_id);
         	if($res['state']&&$res['data']['count']>0)
         	{
         		return array('state' => false,'msg'=>'有管理员属于此角色，请先迁出或者删除','data'=>'');
         	}
         	if($res['state']&&$res['data']['count']==0)
         	{
         		$this->db->where('role_id',$role_id);
	            $this->db->delete('admin_role');
	         	$error = $this->db->error();
			    if(empty($error['code']))
			    {
			    	return array('state' => true,'msg'=>'删除成功','data'=>'');
			    }
			    else{
			    	return array('state' => false,'msg'=>"查询错误:".$error['code'].$error['message'],'data'=>'');die;
			    }
         	}
            else{
            	return array('state' => false,'msg'=>"系统错误:".$res['msg'],'data'=>'');die;
            }
		    
         }
         else{
         	return array('state' => false,'msg'=>'参数错误','data'=>'');
         }  
	          
    }
     /**
	 * 更新管理员登录信息.
	 * @param int $level_num 若为1 获取父级下的一级子分类 若为0 获取全部分类
	 * @param bool $flag     为true,循环查询他的子类（默认）,为flase,只查询父类的一级子类
	 * @return 1，参数异常：返回false 2，无数据：返回null 3，正常：返回数据
	 */
	public function updateAdmin($data, $where) {
		if (is_array($data)) {
			$res = $this->db->update('admin', $data, $where);
			$error = $this->db->error();
			if (!empty($error['code'])) {
				return array('state' => false, 'msg' => "执行错误:" . $error['code'] . $error['message'], 'data' => '');die;
			}
			return array('state' => true, 'msg' => '执行成功', 'data' => '');
		} else {
			return array('state' => false, 'msg' => '参数错误', 'data' => '');
		}
	}

    /** 
    * 方法说明：获取平台信息
    * @param: is_string $where:查询条件 
    * @param: is_string $key:获得的字段
    * @param: is_string $order_by: 排序，
    * @param: is_array  $page:是否启用分页
    * @param: $page['curpage'] 显示起始页
    * @param: $page['rp'] 每页显示的数据
    * @return: 1，参数异常：返回false 查找错误;true 查询成功;
    * @author: MS zhang
    **/ 
    public function getAllLanguage($where,$key='*',$order_by='',$page=array('limit'=>false,'curpage'=>1,'rp'=>50))
    {
        if(is_string($where) && is_string($key) && is_string($order_by) && is_array($page))
        {
            $this->db->select($key);
            $this->db->from('language');
            $this->db->where($where);
            $db=clone($this->db);
            $count=$this->db->count_all_results();
            $this->db=$db;   
            $this->db->order_by($order_by);
            if($page['limit']){
                $this->db->limit($page['rp'],$page['curpage']);
            } 
            $rows = $this->db->get()->result_array();
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
     * 获取一条平台站点语言信息
     * @param  array $data 新增的数据  
     * @return 1，参数异常：返回false 查找错误;true 查询成功
     * @author:MS zhang
     **/
    public function getByLanguage($where,$key='*'){
        if(is_string($where) && is_string($key))
        {
            $this->db->select($key);
            $this->db->from('language');
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

    /**
     * 新增站点语言
     * @param  array $data 新增的数据  
     * @return 1，参数异常：返回false 查找错误;true 查询成功
     * @author:MS zhang
     **/
    public function addLanguage($data)
    { 
        if(is_array($data))
        {
            $this->db->insert('language',$data);
            $error = $this->db->error();
            if(!empty($error['data']))
            {
                return array('state' => false,'msg'=>"执行错误:".$error['code'].$error['message'],'data'=>'');die;
            }
            return array('state' => true,'msg'=>'执行成功','data'=>'');
        }else{
            return array('state' => false,'msg'=>'参数错误','data'=>'');
        }
    }

    /**
     * 编辑站点语言
     * @param  array $data 编辑的数据 
     * @param  string $where 编辑的条件 
     * @return 1，参数异常：返回false 查找错误;true 查询成功
     **/
    public function editLanguage($data,$where)
    {
        if(is_array($data) && is_string($where))
        {
            $res=$this->db->update('language',$data,$where);
            $error=$this->db->error();
            if(!empty($error['data']))
            {
                return array('state' => false,'msg'=>"查询错误:".$error['code'].$error['message'],'data'=>'');die;
            }
            return array('state' => true,'msg'=>'执行成功','data'=>$res);
        }else{
            return array('state' => false,'msg'=>'参数错误','data'=>'');
        }
    }

    /**
     * 删除站点语言
     * @param: $where 删除的条件
     * @return: 1，参数异常：返回false 查找错误;true 查询成功
     * @author: MS zhang
     **/
    public function delLanguage($where)
    {
        if(is_string($where))
        {
            $this->db->where($where)->delete('language');
            $error=$this->db->error();
            if(!empty($error['code']))
            {
                return array('state' => false,'msg'=>"查询错误:".$error['code'].$error['message'],'data'=>'');die;
            }
            return array('state' => true,'msg'=>'查询成功','data'=>'');
        }else{
            return array('state'=>false,'msg'=>'参数传递错误','data'=>'');die;
        }
    }

    /** 
    * 方法说明：友情链接
    * @param: is_string $where:查询条件 
    * @param: is_string $key:获得的字段
    * @param: is_string $order_by: 排序，
    * @param: is_array  $page:是否启用分页
    * @param: $page['curpage'] 显示起始页
    * @param: $page['rp'] 每页显示的数据
    * @return: 1，参数异常：返回false 查找错误;true 查询成功;
    * @author: MS zhang
    **/ 
    public function getAllLink($where,$key='*',$order_by='',$page=array('limit'=>false,'curpage'=>1,'rp'=>50))
    {
        if(is_string($where) && is_string($key) && is_string($order_by) && is_array($page))
        {
            $this->db->select($key);
            $this->db->from('link');
            $this->db->where($where);
            $db=clone($this->db);
            $count=$this->db->count_all_results();
            $this->db=$db;   
            $this->db->order_by($order_by);
            if($page['limit']){
                $this->db->limit($page['rp'],$page['curpage']);
            } 
            $rows = $this->db->get()->result_array();
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
     * 获取一条平台友情链接信息
     * @param  array $data 新增的数据  
     * @return 1，参数异常：返回false 查找错误;true 查询成功
     * @author:MS zhang
     **/
    public function getByLink($where,$key='*'){
        if(is_string($where) && is_string($key))
        {
            $this->db->select($key);
            $this->db->from('link');
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

    /**
     * 新增友情链接
     * @param  array $data 新增的数据  
     * @return 1，参数异常：返回false 查找错误;true 查询成功
     * @author:MS zhang
     **/
    public function addLink($data)
    { 
        if(is_array($data))
        {
            $this->db->insert('link',$data);
            $id = $this->db->insert_id();//自增ID
            $error = $this->db->error();
            if(!empty($error['data']))
            {
                return array('state' => false,'msg'=>"执行错误:".$error['code'].$error['message'],'data'=>'');die;
            }
            return array('state' => true,'msg'=>'执行成功','data'=>$id);
        }else{
            return array('state' => false,'msg'=>'参数错误','data'=>'');
        }
    }

    /**
     * 编辑友情链接
     * @param  array $data 编辑的数据 
     * @param  string $where 编辑的条件 
     * @return 1，参数异常：返回false 查找错误;true 查询成功
     **/
    public function editLink($data,$where)
    {
        if(is_array($data) && is_string($where))
        {
            $res=$this->db->update('link',$data,$where);
            $error=$this->db->error();
            if(!empty($error['data']))
            {
                return array('state' => false,'msg'=>"查询错误:".$error['code'].$error['message'],'data'=>'');die;
            }
            return array('state' => true,'msg'=>'执行成功','data'=>$res);
        }else{
            return array('state' => false,'msg'=>'参数错误','data'=>'');
        }
    }

    /**
     * 删处友情链接
     * @param: $where 删除的条件
     * @return: 1，参数异常：返回false 查找错误;true 查询成功
     * @author: MS zhang
     **/
    public function delLink($where)
    {
        if(is_string($where))
        {
            $this->db->where($where)->delete('link');
            $error=$this->db->error();
            if(!empty($error['code']))
            {
                return array('state' => false,'msg'=>"查询错误:".$error['code'].$error['message'],'data'=>'');die;
            }
            return array('state' => true,'msg'=>'查询成功','data'=>'');
        }else{
            return array('state'=>false,'msg'=>'参数传递错误','data'=>'');die;
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
    /**
     * 新增广告位数据
     * @param  array $data 新增的数据  
     * @return 1，参数异常：返回false 查找错误;true 查询成功
     * @author:MS zhang
     **/
    public function addAdvert($data)
    { 
        if(is_array($data))
        {
            $this->db->insert('adv_position',$data); 
            $error = $this->db->error();
            if(!empty($error['data']))
            {
                return array('state' => false,'msg'=>"执行错误:".$error['code'].$error['message'],'data'=>'');die;
            }
            return array('state' => true,'msg'=>'执行成功','data'=>'');
        }else{
            return array('state' => false,'msg'=>'参数错误','data'=>'');
        }
    }

    /**
     * 编辑广告位置表
     * @param  array $data 编辑的数据 
     * @param  string $where 编辑的条件 
     * @return 1，参数异常：返回false 查找错误;true 查询成功
     **/
    public function editAdvert($data,$where)
    {
        if(is_array($data) && is_string($where))
        {
            $res=$this->db->update('adv_position',$data,$where);
            $error=$this->db->error();
            if(!empty($error['data']))
            {
                return array('state' => false,'msg'=>"查询错误:".$error['code'].$error['message'],'data'=>'');die;
            }
            return array('state' => true,'msg'=>'执行成功','data'=>$res);
        }else{
            return array('state' => false,'msg'=>'参数错误','data'=>'');
        }
    }
    /**
     * 删除广告数据
     * @param: $where 删除的条件
     * @return: 1，参数异常：返回false 查找错误;true 查询成功
     * @author: MS zhang
     **/
    public function delAdvert($where)
    {
        if(is_string($where))
        {
            $this->db->where($where)->delete('adv_position');
            $error=$this->db->error();
            if(!empty($error['code']))
            {
                return array('state' => false,'msg'=>"查询错误:".$error['code'].$error['message'],'data'=>'');die;
            }
            return array('state' => true,'msg'=>'查询成功','data'=>'');
        }else{
            return array('state'=>false,'msg'=>'参数传递错误','data'=>'');die;
        }
    }

    /**
     * 新增广告
     * @param  array $data 新增的数据  
     * @return 1，参数异常：返回false 查找错误;true 查询成功
     * @author:MS zhang
     **/
    public function addAdvertDetails($data)
    { 
        if(is_array($data))
        {
            $this->db->insert('adv',$data); 
            $id = $this->db->insert_id();//自增ID
            $error = $this->db->error();
            if(!empty($error['data']))
            {
                return array('state' => false,'msg'=>"执行错误:".$error['code'].$error['message'],'data'=>'');die;
            }
            return array('state' => true,'msg'=>'执行成功','data'=>$id);
        }else{
            return array('state' => false,'msg'=>'参数错误','data'=>'');
        }
    }

    /**
     * 编辑广告
     * @param  array $data 编辑的数据 
     * @param  string $where 编辑的条件 
     * @return 1，参数异常：返回false 查找错误;true 查询成功
     **/
    public function editAdvertDetails($data,$where)
    {
        if(is_array($data) && is_string($where))
        {
            $res=$this->db->update('adv',$data,$where);
            $error=$this->db->error();
            if(!empty($error['data']))
            {
                return array('state' => false,'msg'=>"查询错误:".$error['code'].$error['message'],'data'=>'');die;
            }
            return array('state' => true,'msg'=>'执行成功','data'=>$res);
        }else{
            return array('state' => false,'msg'=>'参数错误','data'=>'');
        }
    }
    /**
     * 删除广告
     * @param: $where 删除的条件
     * @return: 1，参数异常：返回false 查找错误;true 查询成功
     * @author: MS zhang
     **/
    public function delAdvertDetails($where)
    {
        if(is_string($where))
        {
            $this->db->where($where)->delete('adv');
            $error=$this->db->error();
            if(!empty($error['code']))
            {
                return array('state' => false,'msg'=>"查询错误:".$error['code'].$error['message'],'data'=>'');die;
            }
            return array('state' => true,'msg'=>'查询成功','data'=>'');
        }else{
            return array('state'=>false,'msg'=>'参数传递错误','data'=>'');die;
        }
    }

    /** 
    * 方法说明：项目申请
    * @param: is_string $where:查询条件 
    * @param: is_string $key:获得的字段
    * @param: is_string $order_by: 排序，
    * @param: is_array  $page:是否启用分页
    * @param: $page['curpage'] 显示起始页
    * @param: $page['rp'] 每页显示的数据
    * @return: 1，参数异常：返回false 查找错误;true 查询成功;
    * @author: MS zhang
    **/ 
    public function getAllClaim($where,$key='*',$order_by='',$page=array('limit'=>false,'curpage'=>1,'rp'=>50))
    {
        if(is_string($where) && is_string($key) && is_string($order_by) && is_array($page))
        {
            $this->db->select($key);
            $this->db->from('claim_it as c'); 
            $this->db->join('archives as h','c.archive_id=h.id');
            $this->db->join('admin as a','c.admin_id=a.admin_id','left');
            $this->db->where($where);
            $db=clone($this->db);
            $count=$this->db->count_all_results();
            $this->db=$db;   
            $this->db->order_by($order_by);
            if($page['limit']){
                $this->db->limit($page['rp'],$page['curpage']);
            } 
            $rows = $this->db->get()->result_array(); 
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
     * 编辑项目申请
     * @param  array $data 编辑的数据 
     * @param  string $where 编辑的条件 
     * @return 1，参数异常：返回false 查找错误;true 查询成功
     **/
    public function editClaim($data,$where)
    {
        if(is_array($data) && is_string($where))
        {
            $res=$this->db->update('claim_it',$data,$where);
            $error=$this->db->error();
            if(!empty($error['data']))
            {
                return array('state' => false,'msg'=>"查询错误:".$error['code'].$error['message'],'data'=>'');die;
            }
            return array('state' => true,'msg'=>'执行成功','data'=>$res);
        }else{
            return array('state' => false,'msg'=>'参数错误','data'=>'');
        }
    }

    /** 
    * 方法说明：反馈&建议
    * @param: is_string $where:查询条件 
    * @param: is_string $key:获得的字段
    * @param: is_string $order_by: 排序，
    * @param: is_array  $page:是否启用分页
    * @param: $page['curpage'] 显示起始页
    * @param: $page['rp'] 每页显示的数据
    * @return: 1，参数异常：返回false 查找错误;true 查询成功;
    * @author: MS zhang
    **/ 
    public function getAllProposal($where,$key='*',$order_by='',$page=array('limit'=>false,'curpage'=>1,'rp'=>50))
    {
        if(is_string($where) && is_string($key) && is_string($order_by) && is_array($page))
        {
            $this->db->select($key);
            $this->db->from('proposal as p');
            $this->db->join('admin as a','p.admin_id=a.admin_id','left');
            $this->db->where($where);
            $db=clone($this->db);
            $count=$this->db->count_all_results();
            $this->db=$db;   
            $this->db->order_by($order_by);
            if($page['limit']){
                $this->db->limit($page['rp'],$page['curpage']);
            } 
            $rows = $this->db->get()->result_array(); 
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
     * 编辑意见&建议
     * @param  array $data 编辑的数据 
     * @param  string $where 编辑的条件 
     * @return 1，参数异常：返回false 查找错误;true 查询成功
     **/
    public function editProposal($data,$where)
    {
        if(is_array($data) && is_string($where))
        {
            $res=$this->db->update('proposal',$data,$where);
            $error=$this->db->error();
            if(!empty($error['data']))
            {
                return array('state' => false,'msg'=>"查询错误:".$error['code'].$error['message'],'data'=>'');die;
            }
            return array('state' => true,'msg'=>'执行成功','data'=>$res);
        }else{
            return array('state' => false,'msg'=>'参数错误','data'=>'');
        }
    }

    /** 
    * 方法说明：bounty建议
    * @param: is_string $where:查询条件 
    * @param: is_string $key:获得的字段
    * @param: is_string $order_by: 排序，
    * @param: is_array  $page:是否启用分页
    * @param: $page['curpage'] 显示起始页
    * @param: $page['rp'] 每页显示的数据
    * @return: 1，参数异常：返回false 查找错误;true 查询成功;
    * @author: MS zhang
    **/ 
    public function getAllBounty($where,$key='*',$order_by='',$page=array('limit'=>false,'curpage'=>1,'rp'=>50))
    {
        if(is_string($where) && is_string($key) && is_string($order_by) && is_array($page))
        {
            $this->db->select($key);
            $this->db->from('bounty_ideas as b');
            $this->db->join('admin as a','b.admin_id=a.admin_id','left');
            $this->db->where($where);
            $db=clone($this->db);
            $count=$this->db->count_all_results();
            $this->db=$db;   
            $this->db->order_by($order_by);
            if($page['limit']){
                $this->db->limit($page['rp'],$page['curpage']);
            } 
            $rows = $this->db->get()->result_array(); 
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
     * 编辑bounty建议
     * @param  array $data 编辑的数据 
     * @param  string $where 编辑的条件 
     * @return 1，参数异常：返回false 查找错误;true 查询成功
     **/
    public function editBounty($data,$where)
    {
        if(is_array($data) && is_string($where))
        {
            $res=$this->db->update('bounty_ideas',$data,$where);
            $error=$this->db->error();
            if(!empty($error['data']))
            {
                return array('state' => false,'msg'=>"查询错误:".$error['code'].$error['message'],'data'=>'');die;
            }
            return array('state' => true,'msg'=>'执行成功','data'=>$res);
        }else{
            return array('state' => false,'msg'=>'参数错误','data'=>'');
        }
    }

    /** 
    * 方法说明：ont应用表
    * @param: is_string $where:查询条件 
    * @param: is_string $key:获得的字段
    * @param: is_string $order_by: 排序，
    * @param: is_array  $page:是否启用分页
    * @param: $page['curpage'] 显示起始页
    * @param: $page['rp'] 每页显示的数据
    * @return: 1，参数异常：返回false 查找错误;true 查询成功;
    * @author: MS zhang
    **/ 
    public function getAllOntong($where,$key='*',$order_by='',$page=array('limit'=>false,'curpage'=>1,'rp'=>50))
    {
        if(is_string($where) && is_string($key) && is_string($order_by) && is_array($page))
        {
            $this->db->select($key);
            $this->db->from('ontong_application as o');
            $this->db->join('admin as a','o.admin_id=a.admin_id','left');
            $this->db->where($where);
            $db=clone($this->db);
            $count=$this->db->count_all_results();
            $this->db=$db;   
            $this->db->order_by($order_by);
            if($page['limit']){
                $this->db->limit($page['rp'],$page['curpage']);
            } 
            $rows = $this->db->get()->result_array(); 
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
     * ont应用表编辑
     * @param  array $data 编辑的数据 
     * @param  string $where 编辑的条件 
     * @return 1，参数异常：返回false 查找错误;true 查询成功
     **/
    public function editOntong($data,$where)
    {
        if(is_array($data) && is_string($where))
        {
            $res=$this->db->update('ontong_application',$data,$where);
            $error=$this->db->error();
            if(!empty($error['data']))
            {
                return array('state' => false,'msg'=>"查询错误:".$error['code'].$error['message'],'data'=>'');die;
            }
            return array('state' => true,'msg'=>'执行成功','data'=>$res);
        }else{
            return array('state' => false,'msg'=>'参数错误','data'=>'');
        }
    }

    /** 
    * 方法说明：获取所有的某体文件
    * @param: is_string $where:查询条件 
    * @param: is_string $key:获得的字段
    * @param: is_string $order_by: 排序，
    * @param: is_array  $page:是否启用分页
    * @param: $page['curpage'] 显示起始页
    * @param: $page['rp'] 每页显示的数据
    * @return: 1，参数异常：返回false 查找错误;true 查询成功;
    * @author: MS zhang
    **/ 
    public function getAllMedia($where,$key='*',$order_by='',$page=array('limit'=>false,'curpage'=>1,'rp'=>50))
    {
        if(is_string($where) && is_string($key) && is_string($order_by) && is_array($page))
        {
            $this->db->select($key);
            $this->db->from('media_files');
            $this->db->where($where);
            $db=clone($this->db);
            $count=$this->db->count_all_results();
            $this->db=$db;   
            $this->db->order_by($order_by);
            if($page['limit']){ 
                $this->db->limit($page['rp'],($page['curpage']-1)*$page['rp']);
            } 
            $rows = $this->db->get()->result_array(); 
            $error = $this->db->error();
            if(!empty($error['code']))
            {
               return array('state' => false,'msg'=>"查询错误:".$error['code'].$error['message'],'data'=>'');die;
            }
            return array('state' => true,'msg'=>"查询成功",'data'=>array('count'=>$count,'datas'=>$rows,'curpage'=>$page['curpage'],'rp'=>$page['rp']));
        }else{
            return array('state'=>false,'msg'=>'参数错误','data'=>'');
        }
    }

    /**
     * 获取一条某体文件
     * @param  string where 查询的条件
     * @param  string key 查询的键
     * @return 1，参数异常：返回false 查找错误;true 查询成功
     * @author:MS zhang
     **/
    public function getByMedia($where,$key='*'){
        if(is_string($where) && is_string($key))
        {
            $this->db->select($key); 
            $this->db->from('media_files'); 
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
    /**
     * 新增媒体文件
     * @param  array $data 新增的数据  
     * @return 1，参数异常：返回false 查找错误;true 查询成功
     * @author:Mr zhang
     **/
    public function addMedia($data)
    { 
        if(is_array($data))
        {
            $this->db->insert('media_files',$data); 
            $id = $this->db->insert_id();//自增ID
            $error = $this->db->error();
            if(!empty($error['data']))
            {
                return array('state' => false,'msg'=>"执行错误:".$error['code'].$error['message'],'data'=>'');die;
            }
            return array('state' => true,'msg'=>'执行成功','data'=>$id);
        }else{
            return array('state' => false,'msg'=>'参数错误','data'=>'');
        }
    }
    /**
     * 编辑新增媒体文件
     * @param  array $data 编辑的数据 
     * @param  string $where 编辑的条件 
     * @return 1，参数异常：返回false 查找错误;true 查询成功
     **/
    public function editMedia($data,$where)
    {
        if(is_array($data) && is_string($where))
        {
            $res=$this->db->update('media_files',$data,$where);
            $error=$this->db->error();
            if(!empty($error['data']))
            {
                return array('state' => false,'msg'=>"查询错误:".$error['code'].$error['message'],'data'=>'');die;
            }
            return array('state' => true,'msg'=>'执行成功','data'=>$res);
        }else{
            return array('state' => false,'msg'=>'参数错误','data'=>'');
        }
    }
    
    /**
     * 删除文件
     * @param: $where 删除的条件
     * @return: 1，参数异常：返回false 查找错误;true 查询成功
     * @author: MS zhang
     **/
    public function delMedia($where)
    {
        if(is_string($where))
        {
            $this->db->where($where)->delete('media_files');
            $error=$this->db->error();
            if(!empty($error['code']))
            {
                return array('state' => false,'msg'=>"查询错误:".$error['code'].$error['message'],'data'=>'');die;
            }
            return array('state' => true,'msg'=>'查询成功','data'=>'');
        }else{
            return array('state'=>false,'msg'=>'参数传递错误','data'=>'');die;
        }
    }

    public function get_action($a){
        if(is_string($a)){
             $this->db->select('role_actions');
             $this->db->from('admin_role');
             $this->db->where($a);
             $res=$this->db->get()->result_array();
             $error=$this->db->error();
              if(!empty($error['code'])){
                return array('state' => false,'msg'=>"查询错误:".$error['code'].$error['message'],'data'=>'');die;
            }
            return array('state' => true,'msg'=>'查询成功','data'=>$res);
        }else{
            return array('state' => false,'msg'=>'參數錯誤','data'=>'');die;
        }
       
    }
}