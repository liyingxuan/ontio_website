<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Applym extends CI_Model{
	public function __construct()
    {
        $this->load->database();
        $this->load->language('common');
    }
     /**
     * 提交申请
     * @param  array $data 插入的数据
     * @param  array $pic_path 上传路径、名称等
     * @return 1，参数异常：返回false数组 2，正常：返回true数组
     */
    public function submitBountyClaim($data)
    {
        if (is_array($data)) {
            $this->db->insert('claim_it', $data);
            $id=$this->db->insert_id();
            $error = $this->db->error();
	        if (!empty($error['code'])) {
	            return array('state' => false, 'msg' => "查询错误!".$error['code'].$error['message'], 'data' => '');
	        }
            return array('state' => true, 'msg' => '执行成功', 'data' =>$id);
        }
        else {
	            return array('state' => false, 'msg' => '参数错误', 'data' => '');
	    }
    }
     /**
     * 提交意见
     * @param  array $data 插入的数据
     * @param  array $pic_path 上传路径、名称等
     * @return 1，参数异常：返回false数组 2，正常：返回true数组
     */
    public function submitFeedback($data)
    {
        if (is_array($data)) {
            $this->db->insert('proposal', $data);
            $id=$this->db->insert_id();
            $error = $this->db->error();
	        if (!empty($error['code'])) {
	            return array('state' => false, 'msg' => "查询错误!".$error['code'].$error['message'], 'data' => '');
	        }
            return array('state' => true, 'msg' => '执行成功', 'data' =>$id);
        }
        else {
	            return array('state' => false, 'msg' => '参数错误', 'data' => '');
	    }
    }
     /**
     * idea提交
     * @param  array $data 插入的数据
     * @param  array $pic_path 上传路径、名称等
     * @return 1，参数异常：返回false数组 2，正常：返回true数组
     */
    public function submitIdea($data)
    {
        if (is_array($data)) {
            $this->db->insert('bounty_ideas', $data);
            $id=$this->db->insert_id();
            $error = $this->db->error();
	        if (!empty($error['code'])) {
	            return array('state' => false, 'msg' => "查询错误!".$error['code'].$error['message'], 'data' => '');
	        }
            return array('state' => true, 'msg' => '执行成功', 'data' =>$id);
        }
        else {
	            return array('state' => false, 'msg' => '参数错误', 'data' => '');
	    }
    }  
     /**
     * 应用提交
     * @param  array $data 插入的数据
     * @param  array $pic_path 上传路径、名称等
     * @return 1，参数异常：返回false数组 2，正常：返回true数组
     */
    public function submitApplication($data)
    {
        if (is_array($data)) {
            $this->db->insert('ontong_application', $data);
            $id=$this->db->insert_id();
            $error = $this->db->error();
	        if (!empty($error['code'])) {
	            return array('state' => false, 'msg' => "查询错误!".$error['code'].$error['message'], 'data' => '');
	        }
            return array('state' => true, 'msg' => '执行成功', 'data' =>$id);
        }
        else {
	            return array('state' => false, 'msg' => '参数错误', 'data' => '');
	    }
    }                  
}
?>