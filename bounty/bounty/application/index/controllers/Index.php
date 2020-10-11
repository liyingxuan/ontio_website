<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
	/**
	 * Index Page for this controller.
	 */
    public function __construct() {
        parent::__construct();
    }
    /***
     * bounty页面
     * @author: 了念
     ***/
    public function index(){    
    	$this->load->Model('Articlem');
    	//active bounty
        $where = "c.nid = 'bounty'  and a.arcrank=1 and (a.source='active' or a.source='Closed')";//查模型为节点的数据（nid = node）
        $cols = "a.id,a.title,t.typename,t.id tid,a.shorttitle,a.source,a.click,a.writer,a.label,a.description,a.litpic,c.id cid,d.redirecturl";
        $res = $this->Articlem->getArchives($where,$cols, 0, 100, 't.sortrank ,a.weight');
        if(!$res['state']) {
            echo json_encode(array('state' => false, 'msg' => '查询出错:'.$res['msg'], 'data' => ''));exit;
        }
    	$this->smarty->assign('btat',$res['data']['datas']);
    	
    	//in progress bounty
    	$where = "c.nid = 'bounty' and a.arcrank=1 and a.source='InProgress'";//查模型为节点的数据（nid = node）
        $cols = "a.id,a.title,t.typename,t.id tid,a.shorttitle,a.source,a.click,a.writer,a.label,a.description,a.litpic,c.id cid,d.redirecturl";
        $res = $this->Articlem->getArchives($where,$cols, 0, 100, 't.sortrank ,a.weight');
        if(!$res['state']) {
            echo json_encode(array('state' => false, 'msg' => '查询出错:'.$res['msg'], 'data' => ''));exit;
        }
    	$this->smarty->assign('btip',$res['data']['datas']);
    	
    	//done bounty
    	$where = "c.nid = 'bounty'  and a.arcrank=1 and a.source='Done'";//查模型为节点的数据（nid = node）
        $cols = "a.id,a.title,t.typename,t.id tid,a.shorttitle,a.source,a.click,a.writer,a.label,a.description,a.litpic,c.id cid,d.redirecturl";
        $res = $this->Articlem->getArchives($where,$cols, 0, 100, 't.sortrank ,a.weight');
        if(!$res['state']) {
            echo json_encode(array('state' => false, 'msg' => '查询出错:'.$res['msg'], 'data' => ''));exit;
        }
    	$this->smarty->assign('btd',$res['data']['datas']);
    	//查栏目信息
        $res = $this->Articlem->getArctype("id=27",'typename,seotitle,description,keywords');
        if(!$res['state']) {
            echo json_encode(array('state' => false, 'msg' => '查询栏目信息出错:'.$res['msg']));exit;
        }
        $this->smarty->assign('page',$res['data']);
    	$this->smarty->display('bounty.html');
    }
	public function dapp(){    
		$this->load->Model('Articlem');
        $where = "c.nid = 'dapp'";//查模型为DAPP的数据（nid = dapp）
        $cols = "a.id,a.title,t.typename,t.id tid,a.shorttitle,a.source,a.click,a.writer,a.label,a.description,a.litpic,c.id cid";
        $res = $this->Articlem->getArchives($where,$cols, 0, 100, 't.sortrank ,a.weight');
        if(!$res['state']) {
            echo json_encode(array('state' => false, 'msg' => '查询出错:'.$res['msg'], 'data' => ''));exit;
        }
        foreach($res['data']['datas'] as $k=>$v){
		    $list[$v['tid']][]    =   $v;
		}
        $this->smarty->assign('data',$list);
        
        $this->load->Model('System');
        $where ="d.ap_id=1";
        $key ="d.*,a.ap_name";
        $res=$this->System->getAllAdvertPosition($where,$key,'slide_sort');
    	if(!$res['state']){
    		echo exit(json_encode(array('state'=>false,'msg'=>'获取数据失败'.$res['msg'],'data'=>'')));
    	} 
    	$this->smarty->assign('advlist',$res['data']['datas']);
    	
    	//查栏目信息
        $res = $this->Articlem->getArctype("id =23",'typename,seotitle,description,keywords');
        if(!$res['state']) {
            echo json_encode(array('state' => false, 'msg' => '查询栏目信息出错:'.$res['msg']));exit;
        }
        $this->smarty->assign('page',$res['data']);

	    $this->smarty->display('index.html');

	} 


    /***
     * bounty页面
     * @author: 了念
     ***/
    public function developer(){
    	$this->load->Model('Articlem');
        $where = "c.nid = 'bounty' and a.source='active'";//查模型为节点的数据（nid = node）
        $cols = "a.id,a.title,t.typename,t.id tid,a.shorttitle,a.source,a.click,a.writer,a.label,a.description,a.litpic,c.id cid";
        $res = $this->Articlem->getArchives($where,$cols, 0, 4, 't.sortrank ,a.weight');
        if(!$res['state']) {
            echo json_encode(array('state' => false, 'msg' => '查询出错:'.$res['msg'], 'data' => ''));exit;
        }
        $this->smarty->assign('btat',$res['data']['datas']);
        $this->smarty->display('developer.html');
    }
   /*ont 和 ong的申请表单*/ 
    public function ont_form(){
    	if($_POST)
    	{
            $data['aont'] = isset($_POST['ontamount'])?$_POST['ontamount']:"";
            $data['aong'] = isset($_POST['ongamount'])?$_POST['ongamount']:"";
    		$data['testnet_address'] = isset($_POST['useremail'])?$_POST['useremail']:"";
    		$data['email'] = isset($_POST['useremail'])?$_POST['useremail']:"";
    		$data['name'] = isset($_POST['username'])?$_POST['username']:"";
    		$data['phone'] = isset($_POST['usertel'])?$_POST['usertel']:"";
    		$data['website'] = isset($_POST['userweb'])?$_POST['userweb']:"";
    		$data['team'] = isset($_POST['userteam'])?$_POST['userteam']:"";
    		$data['project'] = isset($_POST['userpro'])?$_POST['userpro']:"";
            $data['submit_time'] =time();
    		$this->load->Model('Applym');
            $this->db->trans_begin();
    		$res = $this->Applym->submitApplication($data);
            if(!$res['state']){
                echo exit(json_encode(array('state'=>false,'msg'=>'系统错误，数据更新失败：'.$res['msg'],'data'=>'')));
            } 
            $res=$this->sendBountyEmail('advise',$data['email'],'123');
            if(!$res['state'])
            {
                $this->db->trans_rollback();
                echo exit(json_encode(array('state'=>false,'msg'=>'邮件发送失败：'.$res['msg'],'data'=>$res['data'])));
            }
            $this->db->trans_commit();
            echo json_encode(array('state' => true, 'msg' =>'提交成功:', 'data' =>$res));exit;
    	}else{
    	    $this->smarty->display('ontApplication.html');
    	}
    }
    /*ont 和 ong的申请表单*/ 
    public function ont_success(){
    	$this->smarty->display('ontSuccess.html');
    }
    /*bounty的申请表单*/ 
    public function bounty_form(){
    	if($_POST)
    	{
            $claimName = isset($_POST['claimName'])&&is_string($_POST['claimName'])?$_POST['claimName']:"";
    		$data['archive_id'] = isset($_POST['claimId'])&&is_numeric($_POST['claimId'])?$_POST['claimId']:"";
    		$data['email'] = isset($_POST['useremail'])?$_POST['useremail']:"";
    		$data['name'] = isset($_POST['username'])?$_POST['username']:"";
    		$data['team_desc'] = isset($_POST['userteam'])?$_POST['userteam']:"";
    		$data['plan_desc'] = isset($_POST['userplan'])?$_POST['userplan']:"";
    		$data['github_address'] = isset($_POST['usergit'])?$_POST['usergit']:"";
    		$data['submit_time'] =time();
    		$timey = isset($_POST['usertime_y'])?$_POST['usertime_y']:"";
    		$timem = isset($_POST['usertime_m'])?$_POST['usertime_m']:"";
    		$timed = isset($_POST['usertime_d'])?$_POST['usertime_d']:"";
    		$data['estimated_time'] =strtotime($timey.'-'.$timem.'-'.$timed);
    		$this->load->Model('Applym');
    		$this->db->trans_begin();
            $res = $this->Applym->submitBountyClaim($data);
            if(!$res['state']){
                echo exit(json_encode(array('state'=>false,'msg'=>'系统错误，数据更新失败：'.$res['msg'],'data'=>'')));
            } 
            $res=$this->sendBountyEmail('apply',$data['email'],$claimName);
            if(!$res['state'])
            {
                $this->db->trans_rollback();
                echo exit(json_encode(array('state'=>false,'msg'=>'邮件发送失败：'.$res['msg'],'data'=>$res['data'])));
            }
            $this->db->trans_commit();
            echo json_encode(array('state' => true, 'msg' =>'提交成功:', 'data' =>$res));exit;
    	}else
    	{
    		$id=$this->input->get('id');
    		if(empty($id))
    		{
    			show_404();
    		}
    		$this->load->Model('Articlem');
    		$where = "a.id =".$id;
            $cols = "a.id,a.title,a.shorttitle,a.flag,a.label,a.weight,a.typeid,a.litpic,a.source,a.writer,a.keywords,a.description,a.click,a.pubdate,a.arcrank,c.body,c.redirecturl";
                //查激励信息
            $res = $this->Articlem->getArchivesAddInfo($where,$cols);
            if(!$res['state']) {
                echo json_encode(array('state' => false, 'msg' =>'查询激励信息失败:'. $res['msg'], 'data' => ''));exit;
            }
            $data = $res['data'];
            if(empty($data)){
                echo json_encode(array('state' => false, 'msg' =>'没有相关数据', 'data' => ''));exit;
            }
            $this->smarty->assign('article', $data);
    		$this->smarty->display('bountyApplication.html');
    	}
    }
    /*bounty的申请表单*/ 
    public function bounty_success(){
    	$this->smarty->display('bountySuccess.html');
    }
    /*idea bounty的申请表单*/ 
    public function idea_form(){
    	if($_POST)
    	{
    		$data['email'] = isset($_POST['useremail'])?$_POST['useremail']:"";
    		$data['name'] = isset($_POST['username'])?$_POST['username']:"";
    		$data['brief_desc'] = isset($_POST['userdes'])?$_POST['userdes']:"";
    		$data['programming_languages'] = isset($_POST['userlang'])?$_POST['userlang']:"";
    		$data['idea_desc'] = isset($_POST['userdetail'])?$_POST['userdetail']:"";
    		$data['budget_requested'] = isset($_POST['userrequest'])?$_POST['userrequest']:"";
    		$data['estimated_time'] = isset($_POST['usercomplete'])?$_POST['usercomplete']:"";
    		$data['submit_time'] =time();
    		$this->load->Model('Applym');
    		$this->db->trans_begin();
            $res = $this->Applym->submitIdea($data);
            if(!$res['state']){
                echo exit(json_encode(array('state'=>false,'msg'=>'系统错误，数据更新失败：'.$res['msg'],'data'=>'')));
            } 
            $res=$this->sendBountyEmail('advise',$data['email'],'123');
            if(!$res['state'])
            {
                $this->db->trans_rollback();
                echo exit(json_encode(array('state'=>false,'msg'=>'邮件发送失败：'.$res['msg'],'data'=>$res['data'])));
            }
            $this->db->trans_commit();
            echo json_encode(array('state' => true, 'msg' =>'提交成功:', 'data' =>$res));exit;
    	}else{
    	   $this->smarty->display('ideaApplication.html');
    	}
    }
    /*idea bounty的申请表单成功*/ 
    public function idea_success(){
    	$this->smarty->display('ideaSuccess.html');
    }
    /*feedback的反馈表单*/ 
    public function feedback(){
    	if($_POST)
    	{
    		$data['email'] = isset($_POST['useremail'])?$_POST['useremail']:"";
    		$data['name'] = isset($_POST['username'])?$_POST['username']:"";
    		$data['content'] = isset($_POST['usersuggest'])?$_POST['usersuggest']:"";
    		$data['submit_time'] =time();
    		$this->load->Model('Applym');
    		$this->db->trans_begin();
            $res = $this->Applym->submitFeedback($data);
            if(!$res['state']){
                echo exit(json_encode(array('state'=>false,'msg'=>'系统错误，数据更新失败：'.$res['msg'],'data'=>'')));
            } 
            $res=$this->sendBountyEmail('advise',$data['email'],'23');
            if(!$res['state'])
            {
                $this->db->trans_rollback();
                echo exit(json_encode(array('state'=>false,'msg'=>'邮件发送失败：'.$res['msg'],'data'=>$res['data'])));
            }
            $this->db->trans_commit();
            echo json_encode(array('state' => true, 'msg' =>'提交成功:', 'data' =>$res));exit;
    	}else{
    	 $this->smarty->display('feedback.html');
        }
    }
    /*feedback成功提交*/ 
    public function feedback_success(){
    	$this->smarty->display('feedbackSuccess.html');
    }
     public function sendBountyEmail($type,$email,$projectName=null)
	{
        if($type=='apply')
        {
            $url="https://ont.io/api/v1/ont/email/send4cms/bounty_receive/";
        }
        elseif ($type=='advise') {
            $url="https://ont.io/api/v1/ont/email/send4cms/bounty_suggest/";
        }
		else
        {
            return array('state'=>false,'msg'=>'不知道的发送主题','data'=>'');
        }
        if(empty($email))
        {
            return array('state'=>false,'msg'=>'请填写邮箱','data'=>'');
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

}
