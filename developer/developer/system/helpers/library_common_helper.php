<?php
/**
 * 公用函数库
 */
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * json对象数组转数组
 * $array json数组
 * @return  array
 */
function object_array($array){
    if(is_object($array)){
        $array = (array)$array;
    }
    if(is_array($array)){
        foreach($array as $key=>$value){
            $array[$key] = object_array($value);
        }
    }
    return $array;
}
/**
 * 设置管理员的session内容
 *
 * @access  public
 * @param   integer $user_id        管理员编号
 * @param   string  $username       管理员姓名
 * @param   string  $action_list    权限列表
 * @param   string  $last_time      最后登录时间
 * @return  void
 */
function set_admin_session($user_id, $username, $action_list, $last_time, $user_type, $role_name)
{
	
    $_SESSION['admin_id']    = $user_id;
    $_SESSION['admin_name']  = $username;
	$_SESSION['user_type']   = $user_type;
    $_SESSION['action_list'] = $action_list;
    $_SESSION['last_check']  = $last_time; // 用于保存最后一次登录的时间
    $_SESSION['role_name']  = $role_name; // 保存角色名字
}
/**
 * 设置分销商的session内容
 *
 * @access  public
 * @param   integer $user_id        管理员编号
 * @param   string  $username       管理员姓名
 * @param   string  $action_list    权限列表
 * @param   string  $role_name      角色
 * @return  void
 */
function set_operate_session($user_id, $username, $action_list,  $role_name, $under_user_id,$agent_rank)
{
	
    $_SESSION['user_id']    = $user_id;
    $_SESSION['user_name']  = $username;
    $_SESSION['agent_action_list'] = $action_list;
    $_SESSION['agent_role_name']  = $role_name; // 保存角色名字
    $_SESSION['under_user_id']  = $under_user_id;   //所属用户ID
    $_SESSION['agent_rank']  = $agent_rank;   //代理等级
}
/**
 * 设置供应商商的session内容
 *
 * @access  public
 * @param   integer $user_id        管理员编号
 * @param   string  $username       管理员姓名
 * @param   string  $action_list    权限列表
 * @param   string  $role_name      角色
 * @return  void
 */
function set_supplier_session($user_id, $username, $action_list,  $role_name, $under_user_id)
{
	
    $_SESSION['user_id']    = $user_id;
    $_SESSION['user_name']  = $username;
    $_SESSION['supplier_action_list'] = $action_list;
    $_SESSION['supplier_role_name']  = $role_name; // 保存角色名字
    $_SESSION['under_user_id']  = $under_user_id;   //所属用户ID
}
/**
 * 设置shop_admin商城后台的session内容
 *
 * @access  public
 * @param   integer $user_id        管理员编号
 * @param   string  $username       管理员姓名
 * @param   string  $action_list    权限列表
 * @param   string  $role_name      角色
 * @return  void
 */
function set_shop_admin_session($user_id, $username, $action_list,$role_name,$last_time)
{
	
    $_SESSION['shop_admin_id']    = $user_id;
    $_SESSION['shop_admin_name']  = $username;
    $_SESSION['shop_admin_action_list'] = $action_list;
    $_SESSION['shop_admin_role_name']  = $role_name; // 保存角色名字
    $_SESSION['shop_admin_last_time']  = $last_time; // 上次登录时间
    $_SESSION['shop_admin_last_ip']  = real_ip(); // 上次登录ip
}
/**
 * 售后日志类型
 */
function set_aftersale_log_type(){
    return $after_sale_state_arr = array('0'=>'未申请','1'=>'待受理','2'=>'待处理','3'=>'待退换货','4'=>'待签收','5'=>'完成','6'=>'拒绝');
}
/**
 * 分页的信息加入条件的数组
 *
 * @access  public
 * @return  array
 */
function page_and_size($filter)
{
    if (isset($_REQUEST['rp']) && intval($_REQUEST['rp']) > 0)
    {
        $filter['rp'] = intval($_REQUEST['rp']);
    }
    
    else
    {
        $filter['rp'] = 15;
    }

    /* 当前页 */
    $filter['page'] = (empty($_REQUEST['curpage']) || intval($_REQUEST['curpage']) <= 0) ? 1 : intval($_REQUEST['curpage']);

    /* page 总数 */
    $filter['page_count'] = (!empty($filter['record_count']) && $filter['record_count'] > 0) ? ceil($filter['record_count'] / $filter['rp']) : 1;

    /* 边界处理 */
    if ($filter['page'] > $filter['page_count'])
    {
        $filter['page'] = $filter['page_count'];
    }

    $filter['start'] = ($filter['page'] - 1) * $filter['rp'];

    return $filter;
}


?>