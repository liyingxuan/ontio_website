<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Help extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
        $this->load->language('common');
    }
    /**
     * 方法说明：查询帮助中心显示一条内容
     * */
    public function getSimpleHelpInfo($where)
    {
		if (is_array($where))
        {
            $query=$this->db->select('*')->from('help')->where($where)->get()->row_array();
            $error = $this->db->error();
            if (!empty($error['code'])) {
                return array('state' => false, 'msg' => "查询错误:" . $error['code'] . $error['message'], 'data' => '');die;
            }
            return array('state' => true, 'msg' => 'it is ok', 'data' => $query);
        }else
        {
            return array('state' => false, 'msg' => '参数传递错误,需要查看键值数组', 'data' => '');die;
        }
    }
    /**
     * 查询帮助中心全部数据与带条件查询
     * @param: $key：要查询的字段 $where查询的条件 $order_by排序查询
     * @return: 一个数组
     **/
    public function getAllHelp($where,$sortname,$sortorder,$curpage=1,$rp=400)
    {
        if(is_array($where) && is_numeric($curpage) && is_numeric($rp))
        {
            $this->db->select('*');
            $this->db->from('help');
//          $this->db->join('help_type', 'help.type_id=help_type.type_id','left');
            $this->db->where($where);
            $db=clone($this->db);
            $count=$this->db->count_all_results();
            $this->db=$db;
            $this->db->order_by($sortname,$sortorder);
            $this->db->limit(($curpage-1)*$rp,0);
            $rows = $this->db->get()->result_array();  
            $error = $this->db->error();
            if (!empty($error['code'])) {
                return array('state' => false, 'msg' => "查询错误:" . $error['code'] . $error['message'], 'data' => '');die;
            }
            return array('state' => true,'msg'=>'查询成功','data'=>array('count'=>$count,'datas'=>$rows));
        }else
        {
            return array('state' => false, 'msg' => '参数传递错误', 'data' => '');die;
        }
    }
    /**
     * 查询所有分类
     * @param: $key：要查询的字段 $where查询的条件
     * @return: 一个数组
     **/
    public function getAllHelpTyp($where,$sortname,$sortorder,$curpage=1,$rp=400)
    {
        if(is_array($where) && is_numeric($curpage) && is_numeric($rp))
        {
            $this->db->select('*');
            $this->db->from('help_type');
            $this->db->where($where);
            $db=clone($this->db);
            $count=$this->db->count_all_results();
            $this->db=$db;
            $this->db->order_by($sortname,$sortorder);
            $this->db->limit(($curpage-1)*$rp,0);
            $rows = $this->db->get()->result_array();
            $error = $this->db->error();
            if (!empty($error['code'])) {
                return array('state' => false, 'msg' => "查询错误:" . $error['code'] . $error['message'], 'data' => '');die;
            }
            return array('state' => true,'msg'=>'查询成功','data'=>array('count'=>$count,'datas'=>$rows));
        }else
        {
            return array('state' => false, 'msg' => '参数传递错误', 'data' => '');die;
        }
    }
}