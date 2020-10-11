<?php
/**
 *Email Class
 *邮件模型类
 */
class Email extends CI_Model {

    public function __construct()
    {
        $this->load->database();
        $this->load->language('common');
    }
     /**
     * 获取邮件模版列表.
     * @param  string $where 查询条件
     * @param  string $orderby 排序条件
     * @param  int  $curpage 当前多少页默认第一页
     * @param  int  $rp 每页多少条，默认40
     * @return 1，参数异常：返回false 2，无数据：返回null 3，正常：返回数据
     */
    public function  getMailTpl($where='1=1',$orderby='tpl_id',$curpage=1,$rp=40)
    {
    	if(is_string($where)&&is_string($orderby)&&is_numeric($curpage)&&is_numeric($rp))
         {
         	$this->db->select('*');
            $this->db->from('mail_tpls');
            $this->db->where($where);
            $db=clone($this->db);
            $count=$this->db->count_all_results();
            $this->db=$db;
            $this->db->order_by($orderby);
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
     * 编辑邮件模版列表.
     * @param  string $where 查询条件
     * @param  string $data 更新内容
     * @return 1，参数异常：返回false 2，无数据：返回null 3，正常：返回数据
     */
    public function  updateMailTpl($data,$where)
    {
    	  if(is_array($data))
         {
            $res = $this->db->update('dpb_mail_tpls', $data, $where);;
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
    }    /**
     * 获取邮件发送日志.
     * @param  string $role_id 查询角色ID号
     * @return 1，参数异常：返回false 查找错误;true 查询成功
     */
    public function getMailLog($where,$orderby='send_id',$curpage=1,$rp=40){
         if(is_string($where)&&is_numeric($curpage)&&is_numeric($rp))
         {
         	$this->db->select('*');
            $this->db->from('mail_log');
            $this->db->where($where);
            $db=clone($this->db);
            $count=$this->db->count_all_results();
            $this->db=$db;
            $this->db->order_by($orderby);
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
     * 删除邮件发送日志.
     * @param  string $where 删除的条件
     * @return 1，参数异常：返回false 查找错误;true 查询成功
     */
    public function delMailLog($where){
         if(is_string($where))
         {
         	$this->db->where($where);
            $re = $this->db->delete('mail_log');  
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
}
?>