<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bounty extends CI_Controller {
	/**
	 * bounty Page for this controller.
	 */
    public function __construct() {
        parent::__construct();
        $this->load->Model('Articlem');
    }
     /***
     * 获取active item list
     * @author: 了念
     ***/
    public function lists(){
        $curpage = isset($_GET['curpage']) ? $_GET['curpage']: 0;
        $rp = isset($_GET['rp']) ? $_GET['rp'] : 40;
        $sortname = isset($_GET['ordername']) ? $_GET['ordername'] : 'a.id';
        $sortorder = isset($_GET['order']) ? $_GET['order'] : 'desc';
        $where = ' 1=1 ';
        $cols = "a.id,a.title,t.typename,g.language,a.arcrank,a.click,m.admin_name,a.pubdate,c.mancon,c.addcon,c.editcon,c.id cid";
        $res = $this->Articlem->getArchives($where,$cols, $curpage, $rp, $sortname, $sortorder);
        if(!$res['state']) {
            echo json_encode(array('state' => false, 'msg' => '查询文章出错:'.$res['msg'], 'data' => ''));exit;
        }
        foreach ($res['data']['datas'] as $key => $row) {
            $res['data']['datas'][$key]['pubdate'] = empty($row['pubdate']) ? '-' : date('Y-m-d H:i:s', $row['pubdate']);
            $res['data']['datas'][$key]['arcrank'] = ($row['arcrank']==1) ? '开放阅读' : '待审核';
        }
        $data['total'] = $res['data']['count'];
        $data['rows'] = $res['data']['datas'];
        echo json_encode($data);die;
	}
}
?>