<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Articles extends CI_Controller {
	/**
	 * Index Page for this controller.
	 */
    public function __construct() {
        parent::__construct();
        $this->load->Model('System');
        $this->load->Model('Articlem');
	}
	/***
     * 栏目管理
     * @author: 了念
     ***/
    public function columns(){
        $this->System->isPriv("columns"); //权限
        if ($_POST) {
            $id = $this->input->post('id');//语言ID
            if(empty($id)){
                echo json_encode(array('state' => false, 'msg' => '参数错误', 'data' => ''));exit;
            }
            $where = "and a.language = $id";
            //获取相应栏目树
            $res=$this->Articlem->getColumnList(0,0,$where);
            // var_dump($res);die;
            if(isset($res['state'])&&!$res['state']) {
                echo json_encode(array('state' => false, 'msg' => '查询栏目树出错:'.$res['msg']));exit;
            }
            echo json_encode(array('state' => true, 'msg' => '获取成功', 'data' => $res));exit;
        }else{
            $lang=isset($_GET['lang'])?$_GET['lang']:"";//添加或编辑完成后的回传语言（根据此参数来展示相应的TAB数据）
            //获取所有语言列表
            $res=$this->Articlem->getLanguage('1=1','lgid,language');
            if(!$res['state']) {
                $this->System->showMessage('获取语言列表出错:'.$res['msg']);
            }
            $this->smarty->assign('language',$res['data']);
            $this->smarty->assign('lang',$lang);
            $this->smarty->display('columns.html');
        }
    }
    /**
     * 栏目删除
     * @author: wl 
     */
    public function column_del(){
        $this->System->isPriv("column_del"); //权限
        $id = $this->input->post('id');
        if(empty($id)){
            echo json_encode(array('state' => false, 'msg' => '参数错误', 'data' => ''));exit;
        }
        $where = "id = $id";
        //查栏目信息
        $res = $this->Articlem->getArctype($where,'typename');
        if(!$res['state']) {
            echo json_encode(array('state' => false, 'msg' => '查询栏目信息出错:'.$res['msg']));exit;
        }
        $data = $res['data'];
        if(empty($data)){
            echo json_encode(array('state' => false, 'msg' =>'没有相关数据', 'data' => ''));exit;
        }
        $con = "删除栏目及其子栏目：".$data['typename'];
        $this->db->trans_begin();
        //递归删除栏目
        $res = $this->Articlem->delArctype($id);
        if($res['state']) {
            $res = $this->System->logAction($con, __METHOD__);
            if(!$res['state']) {
                $this->db->trans_rollback();
                echo json_encode(array('state' => false, 'msg' =>'存删除日志失败:'. $res['msg'], 'data' => ''));exit;
            }
            $this->db->trans_commit();
            echo json_encode(array('state' => true, 'msg' => '删除成功', 'data' => ''));exit;
        }else{
            $this->db->trans_rollback();
            echo json_encode(array('state' => false, 'msg' => '删除失败'.$res['msg'], 'data' => ''));exit;
        }
    }
    /**
     * 栏目编辑
     * @author: wl
     */
    public function column_add(){
        $this->System->isPriv("column_add"); //权限
        if ($_POST) {
            $postData = $this->input->post();
            // var_dump($postData);die;
            $lang=!empty($postData['lang'])?$postData['lang']:"";
            $tag=!empty($postData['tag'])?$postData['tag']:"";
            $id=!empty($postData['id'])?$postData['id']:"";
            if(empty($tag)){
                echo json_encode(array('state' => false, 'msg' => '参数错误', 'data' => ''));exit;
            }
            $data = [];
            $data['ishidden'] = !empty($postData['data_ishidden'])?$postData['data_ishidden']:'';
            $data['channeltype'] = !empty($postData['data_channeltype'])?$postData['data_channeltype']:'';
            $data['language'] = !empty($postData['data_language'])?$postData['data_language']:'';
            $data['typename'] = !empty($postData['data_typename'])?$postData['data_typename']:'';
            // $data['icon'] = !empty($postData['data_icon'])?$postData['data_icon']:'';//图标
            $data['sortrank'] = !empty($postData['data_sortrank'])?$postData['data_sortrank']:'';
            $data['typedir'] = !empty($postData['data_typedir'])?$postData['data_typedir']:'';
            $data['ispart'] = !empty($postData['data_ispart'])?$postData['data_ispart']:'';
            $data['tempindex'] = !empty($postData['data_tempindex'])?$postData['data_tempindex']:'';
            $data['templist'] = !empty($postData['data_templist'])?$postData['data_templist']:'';
            $data['temparticle'] = !empty($postData['data_temparticle'])?$postData['data_temparticle']:'';
            $data['seotitle'] = !empty($postData['data_seotitle'])?$postData['data_seotitle']:'';
            $data['keywords'] = !empty($postData['data_keywords'])?$postData['data_keywords']:'';
            $data['description'] = !empty($postData['data_description'])?$postData['data_description']:'';
            $data['content'] = !empty($postData['data_content'])?$postData['data_content']:'';
            
            //++保存图片
            $pic_path = [];
            $picname = isset($_FILES['data_icon']['name'])?$_FILES['data_icon']['name']:'';
            if (!empty($picname)) {
                $tmp_name = isset($_FILES['data_icon']['tmp_name'])?$_FILES['data_icon']['tmp_name']:'';
                $img_info = getimagesize($tmp_name);
                // if($img_info[0]>55){
                //     echo json_encode(array('state'=>false,'msg'=>'宽度超过上限，请更换图片尺寸','data'=>''));exit;
                // }
                // if($img_info[1]>55){
                //     echo json_encode(array('state'=>false,'msg'=>'高度超过上限，请更换图片尺寸','data'=>''));exit;
                // }
                //判断文件格式
                $type = strstr($picname, '.');
                if ($type!='.png'&&$type!='.svg'&&$type!='.jpg') {
                    echo json_encode(array('state'=>false,'msg'=>'请上传png/svg格式图片','data'=>''));exit;
                }
                $pic_path['type'] = $type;//后缀
                $pic_path['folder'] = 'clumns';//规定放哪个文件夹
            }

            // $data['isdefault'] = !empty($postData['data_isdefault'])?$postData['data_isdefault']:'';
            // $data['defaultname'] = !empty($postData['data_defaultname'])?$postData['data_defaultname']:'';
            // $data['cross'] = !empty($postData['data_cross'])?$postData['data_cross']:'';
            // var_dump($data);die;
            if($tag=='add'){//新增
                $data['reid']=$id;
                $this->db->trans_begin();
                $res=$this->Articlem->addArctype($data,$pic_path);
                if($res['state']) {
                    $dpath = $res['data'];
                    $this->System->logAction('新增栏目:' .$data['typename'] , __METHOD__);
                    if(!$res['state']) {
                        @unlink($dpath);//删除文件
                        $this->db->trans_rollback();
                        echo json_encode(array('state' => false, 'msg' =>'存栏目新增日志失败:'. $res['msg'], 'data' => ''));exit;
                    }
                    $this->db->trans_commit();
                    echo json_encode(array('state'=>true,'msg'=>'新增成功','data'=>$lang));exit;
                }else{
                    $this->db->trans_rollback();
                    echo json_encode(array('state'=>false,'msg'=>'新增失败:'.$res['msg'],'data'=>''));exit;
                }
            }elseif ($tag == 'editor'){//编辑
                //查栏目信息
                $where = "id=$id";
                $cols = "typename,icon";
                $res = $this->Articlem->getArctype($where,$cols);
                if(!$res['state']) {
                    echo json_encode(array('state' => false, 'msg' => '查询栏目信息出错:'.$res['msg']));exit;
                }
                if(empty($res['data'])){
                    echo json_encode(array('state' => false, 'msg' =>'没有相关数据', 'data' => ''));exit;
                }
                $dpic = empty($picname)?"":$res['data']['icon'];

                //++上传图片
                $path = "";
                if(!empty($picname)){//存在图片
                    //上传路径
                    // $name = $id.$pic_path['type']; //名称
                    $name = date ( 'YmdHis' ) . uniqid ('prefix')."_".$id.$pic_path['type'];
                    $folder = ROOTPATH . "data/".$pic_path['folder']."/"; //文件夹路径
                    if (!file_exists($folder)){ //不存在则创建文件夹
                        mkdir($folder);
                    }
                    $path = $folder.$name;
                    if (! move_uploaded_file($_FILES['data_icon']['tmp_name'], $path)) {
                        echo json_encode(array('state'=>false,'msg'=>'上传图片失败，请稍后重新上传','data'=>''));exit;
                    }
                    $fpath = "/data/".$pic_path['folder']."/".$name;
                    //更新图片地址数组
                    $data['icon'] = $fpath;
                }

                $this->db->trans_begin();
                $res=$this->Articlem->editArctype($data,"id=$id",$dpic);
                if($res['state']){
                    $res = $this->System->logAction('编辑栏目:' . $data['typename'], __METHOD__);
                    if(!$res['state']) {
                        @unlink($path);//删除文件
                        $this->db->trans_rollback();
                        echo json_encode(array('state' => false, 'msg' =>'存栏目编辑日志失败:'. $res['msg'], 'data' => ''));exit;
                    }
                    $this->db->trans_commit();
                    echo json_encode(array('state'=>true,'msg'=>'编辑成功','data'=>$lang));exit;
                }else{
                    @unlink($path);//删除文件
                    $this->db->trans_rollback();
                    echo json_encode(array('state'=>false,'msg'=>'编辑失败:'.$res['msg'],'data'=>''));exit;
                }
            }
        }else{//页面
            $tag=isset($_GET['tag'])?$_GET['tag']:"";
            $lang=isset($_GET['language'])?$_GET['language']:"";//添加的语言
            $id=isset($_GET['id'])?$_GET['id']:"";//含id=0（添加顶级分类）的情况，故用另外的参数判定
            $this->smarty->assign('lang',$lang);
            $this->smarty->assign('id',$id);
            if($tag=='editor') {//编辑 
                //获取编辑的栏目信息
                $where = "id=$id";
                // $cols = "id,reid,typename";
                $res = $this->Articlem->getArctype($where);
                if(!$res['state']) {
                    echo json_encode(array('state' => false, 'msg' => '查询栏目信息出错:'.$res['msg']));exit;
                }
                $this->smarty->assign('data',$res['data']);
                $this->smarty->assign('tag','editor');
            }elseif ($tag=='add'){//添加
                $this->smarty->assign('tag','add');
            }
            //获取所有内容模型
            $res=$this->Articlem->getChanneltype('1=1','id,typename');
            if(!$res['state']) {
                echo json_encode(array('state' => false, 'msg' => '获取内容模型出错:'.$res['msg']));exit;
            }
            $channeltype=$res['data'];
            $this->smarty->assign('channeltype',$channeltype);
            //获取所有语言列表
            $res=$this->Articlem->getLanguage('1=1','lgid,language');
            if(!$res['state']) {
                echo json_encode(array('state' => false, 'msg' => '获取语言列表出错:'.$res['msg']));exit;
            }
            $language=$res['data'];
            $this->smarty->assign('language',$language);
            $this->smarty->display('columnAdd.html');
        }
    }
     /***
     * 所有文章
     * @author: 了念
     ***/
    public function index(){
        $this->System->isPriv("index"); //权限
        if ($_POST) {
            $curpage=isset($_POST["start"]) ? $_POST["start"]:0;
            $rp  =isset($_POST["length"]) ? $_POST["length"]:50;
            $type  =isset($_POST["type"]) ? $_POST["type"]:"";//普通文章传的参数
            //后台排序
            $orderArr = isset($_POST['order']) ? $_POST['order'] : '';
            $sortType = "asc";
            $sortName = "t.sortrank,a.weight";
            if(!empty($orderArr)){
                if(!isset($orderArr[1])){
                    $sortType = $orderArr[0]['dir'];
                    switch ($orderArr[0]['column']){
                        case '1':
                            $sortName = "t.sortrank,a.weight";
                            break;
                        case '2':
                            $sortName = "a.title";
                            break;
                        case '3':
                            $sortName = "t.typename";
                            break;
                        case '4':
                            $sortName = "g.language";
                            break;
                        case '5':
                            $sortName = "a.arcrank";
                        case '6':
                            $sortName = "a.click";
                        case '7':
                            $sortName = "a.admin_name";
                        case '8':
                            $sortName = "a.pubdate";
                            break;
                        default:
                            $sortName = "t.sortrank,a.weight";
                    }
                } 
            }
            $where = ' 1=1 ';
            $where .= empty($type)?"":" and c.nid = '$type'";//查模型为普通文章的数据（nid = content）
            // $cols = "a.id,a.title,t.typename,g.language,a.arcrank,a.click,m.admin_name,a.pubdate,concat(a.id,';',c.nid,',',c.maintable,',',c.addtable,',',c.addcon,',',c.mancon,',',c.editcon,';',c.listfields) as info";
            $cols = "a.id,a.title,t.typename,g.language,a.arcrank,a.click,m.admin_name,a.pubdate,c.mancon,c.addcon,c.editcon,c.id cid";
            $res = $this->Articlem->getArchives($where,$cols, $curpage, $rp, $sortName, $sortType);
            if(!$res['state']) {
                echo json_encode(array('state' => false, 'msg' => '查询文章出错:'.$res['msg'], 'data' => ''));exit;
            }
            $list=$res['data']['datas'];
            if(empty($list)){
                $datas=array(
                  "sEcho"=>$this->input->get('sEcho',true),
                  "iTotalDisplayRecords"=>0,
                  "iTotalRecords"=>0,
                  "aaData"=>array()
                );
                echo exit(json_encode($datas));die;
            }
            foreach ($list as $key => $row) {
                $list[$key]['pubdate'] = empty($row['pubdate']) ? '-' : date('Y-m-d H:i:s', $row['pubdate']);
                $list[$key]['arcrank'] = ($row['arcrank']==1) ? '开放阅读' : '待审核';
            }
            $datas=array(
              "sEcho"=>$this->input->get('sEcho',true),
              "iTotalDisplayRecords"=>intval($res['data']['count']),
              "iTotalRecords"=>intval($res['data']['count']),
              "aaData"=>$list
            ); 
            echo exit(json_encode($datas));
        }else{//模板页面
            $type = isset($_GET['type']) ? $_GET['type']:'';
            if(!empty($type)){
                $this->smarty->assign('type',$type);
            }
            $this->smarty->display('articles.html');
        }
    }
    /**
     * 文章删除
     * @author: wl
     */
    public function article_del(){
        $this->System->isPriv("article_del"); //权限
        $this->news_del();
    }
    /**
     * 文章删除公用方法
     * @author: wl
     */
    public function news_del(){
        $id = $this->input->get('id');
        if(empty($id)){
            echo json_encode(array('state' => false, 'msg' => '参数错误', 'data' => ''));exit;
        }
        $where = "a.id = $id";
        $cols = "a.title,c.maintable,c.addtable,a.litpic";
        //查文章信息
        $res = $this->Articlem->getChannelArchivesInfo($where,$cols);
        if(!$res['state']) {
            echo json_encode(array('state' => false, 'msg' =>'查询文章信息失败:'. $res['msg'], 'data' => ''));exit;
        }
        $data = $res['data'];
        if(empty($data)){
            echo json_encode(array('state' => false, 'msg' =>'没有相关数据', 'data' => ''));exit;
        }
        $con = "删除文章：".$data['title'];
        $maintable = ltrim($data['maintable'],'_');
        $addtable = !empty($data['addtable'])?ltrim($data['addtable'],'_'):"";
        $this->db->trans_begin();
        $tables = [$maintable,$addtable];
        $where1 = "id = $id";
        $where2 = "aid = $id";
        $res = $this->Articlem->delArticle($tables,$where1,$where2,$res['data']['litpic']);
        if($res['state']) {
            $res = $this->System->logAction($con, __METHOD__);
            if(!$res['state']) {
                $this->db->trans_rollback();
                echo json_encode(array('state' => false, 'msg' =>'存删除日志失败:'. $res['msg'], 'data' => ''));exit;
            }
            $this->db->trans_commit();
            echo json_encode(array('state' => true, 'msg' => '删除成功', 'data' => ''));exit;
        }else{
            $this->db->trans_rollback();
            echo json_encode(array('state' => false, 'msg' => '删除失败'.$res['msg'], 'data' => ''));exit;
        }
    }
	 /***
     * 新闻添加
     * @author: 了念
     ***/
    public function  article_add(){
        $this->System->isPriv("article_add"); //权限
        if ($_POST) {//编辑或者添加
            $postData = $this->input->post();
            $id = isset($postData['article_id'])?$postData['article_id']:"";
            $article_title = isset($postData['article_title'])?$postData['article_title']:"";
            $article_typeid = isset($postData['article_typeid'])?$postData['article_typeid']:"";
            // var_dump($postData);die;
            if(empty($article_title)||empty($article_typeid)){
                echo json_encode(array('state' => false, 'msg' => '参数错误', 'data' => ''));exit;
            }
            $data1 = [];//主表数据
            $data2 = [];//附表数据

            $data1['title'] = $article_title;//标题
            $data1['shorttitle'] = !empty($postData['article_shorttitle'])?$postData['article_shorttitle']:'';//简略标题
            $data1['flag'] = !empty($postData['article_flag'])?implode(',',$postData['article_flag']):'';//自定义属性
            $data1['label'] = !empty($postData['article_label'])?$postData['article_label']:'';//标签
            $data1['weight'] = !empty($postData['article_weight'])?$postData['article_weight']:'';//权重
            $data1['typeid'] = $article_typeid;//栏目ID
            $data1['source'] = !empty($postData['article_source'])?$postData['article_source']:'';//来源
            $data1['writer'] = !empty($postData['article_writer'])?$postData['article_writer']:'';//作者
            $data1['keywords'] = !empty($postData['article_keywords'])?$postData['article_keywords']:'';//关键字
            $data1['description'] = !empty($postData['article_description'])?$postData['article_description']:'';//内容摘要
            $data1['click'] = !empty($postData['article_click'])?$postData['article_click']:'';//浏览次数
            $data1['pubdate'] = !empty($postData['article_pubdate'])?strtotime($postData['article_pubdate']):'';//发布时间
            $data1['arcrank'] = !empty($postData['article_arcrank'])?$postData['article_arcrank']:'';//阅读权限

            $data2['typeid'] = !empty($postData['article_typeid'])?$postData['article_typeid']:'';//栏目ID
            $data2['body'] = !empty($postData['add_body'])?$postData['add_body']:'';//内容
            $tables = ['archives','addonarticle'];

            //++保存图片
            $pic_path = [];
            $picname = isset($_FILES['article_litpic']['name'])?$_FILES['article_litpic']['name']:'';
            if (!empty($picname)) {
                $tmp_name = isset($_FILES['article_litpic']['tmp_name'])?$_FILES['article_litpic']['tmp_name']:'';
                $img_info = getimagesize($tmp_name);
                // if($img_info[0]>55){
                //     echo json_encode(array('state'=>false,'msg'=>'宽度超过上限，请更换图片尺寸','data'=>''));exit;
                // }
                // if($img_info[1]>55){
                //     echo json_encode(array('state'=>false,'msg'=>'高度超过上限，请更换图片尺寸','data'=>''));exit;
                // }
                //判断文件格式
                $type = strstr($picname, '.');
                if ($type!='.png'&&$type!='.svg'&&$type!='.jpg') {
                    echo json_encode(array('state'=>false,'msg'=>'请上传png/svg格式图片','data'=>''));exit;
                }
                $pic_path['type'] = $type;//后缀
                $pic_path['folder'] = 'articles';//规定放哪个文件夹
            }

            // var_dump($id);die;
            if(empty($id)){//添加
                $this->db->trans_begin();
                //添加文章、附表数据
                $res = $this->Articlem->addArticle($tables,$data1,$data2,$pic_path);
                if($res['state']) {
                    $dpath = $res['data'];
                    $con = "添加文章：".$article_title;
                    $res = $this->System->logAction($con, __METHOD__);
                    if(!$res['state']) {
                        @unlink($dpath);//删除文件
                        $this->db->trans_rollback();
                        echo json_encode(array('state' => false, 'msg' =>'存添加日志失败:'. $res['msg'], 'data' => ''));exit;
                    }
                    $this->db->trans_commit();
                    echo json_encode(array('state' => true, 'msg' => '添加成功', 'data' => ''));exit;
                }else{
                    $this->db->trans_rollback();
                    echo json_encode(array('state' => false, 'msg' => '添加失败'.$res['msg'], 'data' => ''));exit;
                }
            }else{//编辑
                $where = "a.id = $id";
                // $cols = "a.title,a.shorttitle,a.flag,a.label,a.weight,a.typeid,a.litpic,a.source,a.writer,a.keywords,a.description,a.click,a.pubdate,a.arcrank,c.typeid,c.body";
                $cols = "a.title,a.litpic";
                //查文章信息
                $res = $this->Articlem->getChannelArchivesInfo($where,$cols);
                if(!$res['state']) {
                    echo json_encode(array('state' => false, 'msg' =>'查询文章信息失败:'. $res['msg'], 'data' => ''));exit;
                }
                if(empty($res['data'])){
                    echo json_encode(array('state' => false, 'msg' =>'没有相关数据', 'data' => ''));exit;
                }
                $con = "编辑文章：".$res['data']['title'];
                $dpic = empty($picname)?"":$res['data']['litpic'];
                //++上传图片
                $path = "";
                if(!empty($picname)){//存在图片
                    //上传路径
                    // $name = $id.$pic_path['type']; //名称
                    $name = date ( 'YmdHis' ) . uniqid ('prefix')."_".$id.$pic_path['type'];
                    $folder = ROOTPATH . "data/".$pic_path['folder']."/"; //文件夹路径
                    if (!file_exists($folder)){ //不存在则创建文件夹
                        mkdir($folder);
                    }
                    $path = $folder.$name;
                    if (! move_uploaded_file($_FILES['article_litpic']['tmp_name'], $path)) {
                        echo json_encode(array('state'=>false,'msg'=>'上传图片失败，请稍后重新上传','data'=>''));exit;
                    }
                    $fpath = "/data/".$pic_path['folder']."/".$name;
                    //更新图片地址数组
                    $data1['litpic'] = $fpath;
                }

                $this->db->trans_begin();
                //更新相应表数据
                $res = $this->Articlem->editArticle($tables,$data1,$data2,"id = $id","aid = $id",$dpic);
                if($res['state']) {
                    $con = "修改文章：".$article_title;
                    $res = $this->System->logAction($con, __METHOD__);
                    if(!$res['state']) {
                        @unlink($path);//删除文件
                        $this->db->trans_rollback();
                        echo json_encode(array('state' => false, 'msg' =>'存修改日志失败:'. $res['msg'], 'data' => ''));exit;
                    }
                    $this->db->trans_commit();
                    echo json_encode(array('state' => true, 'msg' => '修改成功', 'data' => ''));exit;
                }else{
                    @unlink($path);//删除文件
                    $this->db->trans_rollback();
                    echo json_encode(array('state' => false, 'msg' => '修改失败'.$res['msg'], 'data' => ''));exit;
                }
            } 
        }else{//页面
            $id=isset($_GET['id'])?$_GET['id']:false;//编辑时传的id
            $type = isset($_GET['type']) ? $_GET['type']:'';//区别普通文章的参数
            if(!empty($type)){
                $this->smarty->assign('type',$type);
            }
            if($id) {//编辑
                $where = "a.id = $id";
                $cols = "a.title,a.shorttitle,a.flag,a.label,a.weight,a.typeid,a.litpic,a.source,a.writer,a.keywords,a.description,a.click,a.pubdate,a.arcrank,c.body";//,c.typeid
                //查文章信息
                $res = $this->Articlem->getArchivesAddInfo($where,$cols);
                if(!$res['state']) {
                    echo json_encode(array('state' => false, 'msg' =>'查询文章信息失败:'. $res['msg'], 'data' => ''));exit;
                }
                $data = $res['data'];
                if(empty($data)){
                    echo json_encode(array('state' => false, 'msg' =>'没有相关数据', 'data' => ''));exit;
                }
                $this->smarty->assign('article', $data);
                $this->smarty->assign('id', $id);
            }
            //查栏目数据
            $column=$this->Articlem->getColumn();
            if(isset($column['state'])&&!$column['state']) {
                $this->System->showMessage('查询栏目出错:'.$column['msg']);
            }
            $this->smarty->assign('column',$column);
            //查文章来源数据
            $res=$this->Articlem->getGroupArchives('1=1','source');
            if(isset($res['state'])&&!$res['state']) {
                $this->System->showMessage('查询文章来源出错:'.$res['msg']);
            }
            $this->smarty->assign('source',$res['data']);
            //查文章作者数据
            $res=$this->Articlem->getGroupArchives('1=1','writer');
            if(isset($res['state'])&&!$res['state']) {
                $this->System->showMessage('查询文章作者出错:'.$res['msg']);
            }
            $this->smarty->assign('writer',$res['data']);
            $this->smarty->display('articleNews.html');
        }
    }
    // =======================================================团队=====================================================================
    /**
     * 团队
     * @author: wl
     */
    public function team() {
        $this->System->isPriv("team"); //权限
        if($_POST){
            $curpage=isset($_POST["start"]) ? $_POST["start"]:0;
            $rp  =isset($_POST["length"]) ? $_POST["length"]:50;
            //后台排序
            $orderArr = isset($_POST['order']) ? $_POST['order'] : '';
            $sortType = "asc";
            $sortName = "t.sortrank,a.weight";
            if(!empty($orderArr)){
                if(!isset($orderArr[1])){
                    $sortType = $orderArr[0]['dir'];
                    switch ($orderArr[0]['column']){
                        case '1':
                            $sortName = "t.sortrank,a.weight";
                            break;
                        case '2':
                            $sortName = "a.writer";
                            break;
                        case '3':
                            $sortName = "t.typename";
                            break;
                        case '4':
                            $sortName = "a.shorttitle";
                            break;
                        case '5':
                            $sortName = "a.click";
                            break;
                        default:
                            $sortName = "t.sortrank,a.weight";
                    }
                } 
            }
            $where = "c.nid = 'team'";//查模型为团队的数据（nid = team）
            $cols = "a.id,a.writer,t.typename,a.shorttitle,a.click,c.mancon,c.addcon,c.id cid";
            $res = $this->Articlem->getArchives($where,$cols, $curpage, $rp, $sortName, $sortType);
            if(!$res['state']) {
                echo json_encode(array('state' => false, 'msg' => '查询出错:'.$res['msg'], 'data' => ''));exit;
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
            $this->smarty->display('team.html');
        } 
    }
    /**
     * 团队删除
     * @author: wl
     */
    public function team_del(){
        $this->System->isPriv("team_del"); //权限
        $this->news_del();
    }
     /***
     * 团队添加
     * @author: wl
     ***/
    public function  team_add(){
        $this->System->isPriv("team_add"); //权限
        if ($_POST) {//编辑或者添加
            $postData = $this->input->post();
            $id = isset($postData['article_id'])?$postData['article_id']:"";
            $article_writer = isset($postData['article_writer'])?$postData['article_writer']:"";
            $article_typeid = isset($postData['article_typeid'])?$postData['article_typeid']:"";
            // var_dump($_FILES);
            // var_dump($postData);die;
            if(empty($article_writer)||empty($article_typeid)){
                echo json_encode(array('state' => false, 'msg' => '参数错误', 'data' => ''));exit;
            }
            $data1 = [];//主表数据
            $data2 = [];//附表数据

            $data1['writer'] = !empty($postData['article_writer'])?$postData['article_writer']:'';//姓名
            $data1['shorttitle'] = !empty($postData['article_shorttitle'])?$postData['article_shorttitle']:'';//职务
            $data1['flag'] = !empty($postData['article_flag'])?implode(',',$postData['article_flag']):'';//自定义属性
            $data1['label'] = !empty($postData['article_label'])?$postData['article_label']:'';//标签
            $data1['weight'] = !empty($postData['article_weight'])?$postData['article_weight']:'';//权重
            $data1['typeid'] = $article_typeid;//栏目ID
            $data1['keywords'] = !empty($postData['article_keywords'])?$postData['article_keywords']:'';//关键字
            $data1['description'] = !empty($postData['article_description'])?$postData['article_description']:'';//内容摘要
            $data1['click'] = !empty($postData['article_click'])?$postData['article_click']:'';//浏览次数
            $data1['pubdate'] = !empty($postData['article_pubdate'])?strtotime($postData['article_pubdate']):'';//发布时间
            $data1['arcrank'] = !empty($postData['article_arcrank'])?$postData['article_arcrank']:'';//阅读权限

            $data2['typeid'] = !empty($postData['article_typeid'])?$postData['article_typeid']:'';//栏目ID
            $data2['body'] = !empty($postData['add_body'])?$postData['add_body']:'';//内容
            $tables = ['archives','addonarticle'];

            //++保存图片
            $pic_path = [];
            $picname = isset($_FILES['article_litpic']['name'])?$_FILES['article_litpic']['name']:'';
            if (!empty($picname)) {
                $tmp_name = isset($_FILES['article_litpic']['tmp_name'])?$_FILES['article_litpic']['tmp_name']:'';
                $img_info = getimagesize($tmp_name);
                // if($img_info[0]>55){
                //     echo json_encode(array('state'=>false,'msg'=>'宽度超过上限，请更换图片尺寸','data'=>''));exit;
                // }
                // if($img_info[1]>55){
                //     echo json_encode(array('state'=>false,'msg'=>'高度超过上限，请更换图片尺寸','data'=>''));exit;
                // }
                //判断文件格式
                $type = strstr($picname, '.');
                if ($type!='.png'&&$type!='.svg'&&$type!='.jpg') {
                    echo json_encode(array('state'=>false,'msg'=>'请上传png/svg格式图片','data'=>''));exit;
                }
                $pic_path['type'] = $type;//后缀
                $pic_path['folder'] = 'articles';//规定放哪个文件夹
            }
            
            // var_dump($id);die;
            if(empty($id)){//添加
                $this->db->trans_begin();
                //添加团队、附表、图片数据
                $res = $this->Articlem->addArticle($tables,$data1,$data2,$pic_path);
                if($res['state']) {
                    $dpath = $res['data'];
                    $con = "添加团队：".$article_writer;
                    $res = $this->System->logAction($con, __METHOD__);
                    if(!$res['state']) {
                        @unlink($dpath);//删除文件
                        $this->db->trans_rollback();
                        echo json_encode(array('state' => false, 'msg' =>'存添加日志失败:'. $res['msg'], 'data' => ''));exit;
                    }
                    $this->db->trans_commit();
                    echo json_encode(array('state' => true, 'msg' => '添加成功', 'data' => ''));exit;
                }else{
                    $this->db->trans_rollback();
                    echo json_encode(array('state' => false, 'msg' => '添加失败'.$res['msg'], 'data' => ''));exit;
                }
            }else{//编辑
                $where = "a.id = $id";
                $cols = "a.writer,a.litpic";
                //查文章信息
                $res = $this->Articlem->getChannelArchivesInfo($where,$cols);
                if(!$res['state']) {
                    echo json_encode(array('state' => false, 'msg' =>'查询团队信息失败:'. $res['msg'], 'data' => ''));exit;
                }
                if(empty($res['data'])){
                    echo json_encode(array('state' => false, 'msg' =>'没有相关数据', 'data' => ''));exit;
                }
                $con = "编辑团队：".$res['data']['writer'];
                $dpic = empty($picname)?"":$res['data']['litpic'];
                //++上传图片
                $path = "";
                if(!empty($picname)){//存在图片
                    //上传路径
                    // $name = $id.$pic_path['type']; //名称
                    $name = date ( 'YmdHis' ) . uniqid ('prefix')."_".$id.$pic_path['type'];
                    $folder = ROOTPATH . "data/".$pic_path['folder']."/"; //文件夹路径
                    if (!file_exists($folder)){ //不存在则创建文件夹
                        mkdir($folder);
                    }
                    $path = $folder.$name;
                    if (! move_uploaded_file($_FILES['article_litpic']['tmp_name'], $path)) {
                        echo json_encode(array('state'=>false,'msg'=>'上传图片失败，请稍后重新上传','data'=>''));exit;
                    }
                    $fpath = "/data/".$pic_path['folder']."/".$name;
                    //更新图片地址数组
                    $data1['litpic'] = $fpath;
                }

                $this->db->trans_begin();
                //更新相应表数据
                $res = $this->Articlem->editArticle($tables,$data1,$data2,"id = $id","aid = $id",$dpic);
                if($res['state']) {
                    $con = "修改团队：".$article_writer;
                    $res = $this->System->logAction($con, __METHOD__);
                    if(!$res['state']) {
                        @unlink($path);//删除文件
                        $this->db->trans_rollback();
                        echo json_encode(array('state' => false, 'msg' =>'存修改日志失败:'. $res['msg'], 'data' => ''));exit;
                    }
                    $this->db->trans_commit();
                    echo json_encode(array('state' => true, 'msg' => '修改成功', 'data' => ''));exit;
                }else{
                    @unlink($path);//删除文件
                    $this->db->trans_rollback();
                    echo json_encode(array('state' => false, 'msg' => '修改失败'.$res['msg'], 'data' => ''));exit;
                }
            } 
        }else{//页面
            $id=isset($_GET['id'])?$_GET['id']:false;//编辑时传的id
            if($id) {//编辑
                $where = "a.id = $id";
                $cols = "a.writer,a.shorttitle,a.flag,a.label,a.weight,a.typeid,a.litpic,a.keywords,a.description,a.click,a.pubdate,a.arcrank,c.body";
                //查团队信息
                $res = $this->Articlem->getArchivesAddInfo($where,$cols);
                if(!$res['state']) {
                    echo json_encode(array('state' => false, 'msg' =>'查询团队信息失败:'. $res['msg'], 'data' => ''));exit;
                }
                $data = $res['data'];
                if(empty($data)){
                    echo json_encode(array('state' => false, 'msg' =>'没有相关数据', 'data' => ''));exit;
                }
                $this->smarty->assign('article', $data);
                $this->smarty->assign('id', $id);
            }else{
                //查所属栏目,便于前台展示
                $res = $this->Articlem->getDisplayColumn("c.nid='team'",'a.id');
                if(!$res['state']) {
                    echo json_encode(array('state' => false, 'msg' =>'查询团队信息失败:'. $res['msg'], 'data' => ''));exit;
                }
                $data = $res['data'];
                $article = [];
                if(!empty($data)){
                    $article['typeid'] = $data['id'];
                    $this->smarty->assign('article', $article);
                }
            }
            //查栏目数据
            $column=$this->Articlem->getColumn();
            if(isset($column['state'])&&!$column['state']) {
                $this->System->showMessage('查询栏目出错:'.$column['msg']);
            }
            $this->smarty->assign('column',$column);

            $this->smarty->display('articleTeam.html');
        }
    }
// =======================================================节点=====================================================================
    /**
     * 节点
     * @author: wl
     */
    public function node() {
        $this->System->isPriv("node"); //权限
        if($_POST){
            $curpage=isset($_POST["start"]) ? $_POST["start"]:0;
            $rp  =isset($_POST["length"]) ? $_POST["length"]:50;
            //后台排序
            $orderArr = isset($_POST['order']) ? $_POST['order'] : '';
            $sortType = "asc";
            $sortName = "t.sortrank,a.weight";
            if(!empty($orderArr)){
                if(!isset($orderArr[1])){
                    $sortType = $orderArr[0]['dir'];
                    switch ($orderArr[0]['column']){
                        case '1':
                            $sortName = "t.sortrank,a.weight";
                            break;
                        case '2':
                            $sortName = "a.title";
                            break;
                        case '3':
                            $sortName = "t.typename";
                            break;
                        case '4':
                            $sortName = "a.shorttitle";
                            break;
                        case '5':
                            $sortName = "a.click";
                            break;
                        default:
                            $sortName = "t.sortrank,a.weight";
                    }
                } 
            }
            $where = "c.nid = 'node'";//查模型为节点的数据（nid = node）
            $cols = "a.id,a.title,t.typename,a.shorttitle,a.click,c.mancon,c.addcon,c.id cid";
            $res = $this->Articlem->getArchives($where,$cols, $curpage, $rp, $sortName, $sortType);
            if(!$res['state']) {
                echo json_encode(array('state' => false, 'msg' => '查询出错:'.$res['msg'], 'data' => ''));exit;
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
            $this->smarty->display('node.html');
        } 
    }
    /**
     * 节点删除
     * @author: wl
     */
    public function node_del(){
        $this->System->isPriv("node_del"); //权限
        $this->news_del();
    }
     /***
     * 节点添加
     * @author: wl
     ***/
    public function  node_add(){
        $this->System->isPriv("node_add"); //权限
        if ($_POST) {//编辑或者添加
            $postData = $this->input->post();
            $id = isset($postData['article_id'])?$postData['article_id']:"";
            $article_title = isset($postData['article_title'])?$postData['article_title']:"";
            $article_typeid = isset($postData['article_typeid'])?$postData['article_typeid']:"";
            // var_dump($_FILES);
            // var_dump($postData);die;
            if(empty($article_title)||empty($article_typeid)){
                echo json_encode(array('state' => false, 'msg' => '参数错误', 'data' => ''));exit;
            }
            $data1 = [];//主表数据
            $data2 = [];//附表数据

            $data1['title'] = !empty($postData['article_title'])?$postData['article_title']:'';//节点名称
            $data1['shorttitle'] = !empty($postData['article_shorttitle'])?$postData['article_shorttitle']:'';//地区
            $data1['flag'] = !empty($postData['article_flag'])?implode(',',$postData['article_flag']):'';//自定义属性
            $data1['label'] = !empty($postData['article_label'])?$postData['article_label']:'';//标签
            $data1['weight'] = !empty($postData['article_weight'])?$postData['article_weight']:'';//权重
            $data1['typeid'] = $article_typeid;//栏目ID
            $data1['keywords'] = !empty($postData['article_keywords'])?$postData['article_keywords']:'';//关键字
            $data1['description'] = !empty($postData['article_description'])?$postData['article_description']:'';//内容摘要
            $data1['click'] = !empty($postData['article_click'])?$postData['article_click']:'';//浏览次数
            $data1['pubdate'] = !empty($postData['article_pubdate'])?strtotime($postData['article_pubdate']):'';//发布时间
            $data1['arcrank'] = !empty($postData['article_arcrank'])?$postData['article_arcrank']:'';//阅读权限

            $data2['typeid'] = !empty($postData['article_typeid'])?$postData['article_typeid']:'';//栏目ID
            $data2['body'] = !empty($postData['add_body'])?$postData['add_body']:'';//内容
            $tables = ['archives','addonarticle'];

            //++保存图片
            $pic_path = [];
            $picname = isset($_FILES['article_litpic']['name'])?$_FILES['article_litpic']['name']:'';
            if (!empty($picname)) {
                $tmp_name = isset($_FILES['article_litpic']['tmp_name'])?$_FILES['article_litpic']['tmp_name']:'';
                $img_info = getimagesize($tmp_name);
                // if($img_info[0]>55){
                //     echo json_encode(array('state'=>false,'msg'=>'宽度超过上限，请更换图片尺寸','data'=>''));exit;
                // }
                // if($img_info[1]>55){
                //     echo json_encode(array('state'=>false,'msg'=>'高度超过上限，请更换图片尺寸','data'=>''));exit;
                // }
                //判断文件格式
                $type = strstr($picname, '.');
                if ($type!='.png'&&$type!='.svg'&&$type!='.jpg') {
                    echo json_encode(array('state'=>false,'msg'=>'请上传png/svg格式图片','data'=>''));exit;
                }
                $pic_path['type'] = $type;//后缀
                $pic_path['folder'] = 'articles';//规定放哪个文件夹
            }
            
            // var_dump($id);die;
            if(empty($id)){//添加
                $this->db->trans_begin();
                //添加节点、附表、图片数据
                $res = $this->Articlem->addArticle($tables,$data1,$data2,$pic_path);
                if($res['state']) {
                    $dpath = $res['data'];
                    $con = "添加节点：".$article_title;
                    $res = $this->System->logAction($con, __METHOD__);
                    if(!$res['state']) {
                        @unlink($dpath);//删除文件
                        $this->db->trans_rollback();
                        echo json_encode(array('state' => false, 'msg' =>'存添加日志失败:'. $res['msg'], 'data' => ''));exit;
                    }
                    $this->db->trans_commit();
                    echo json_encode(array('state' => true, 'msg' => '添加成功', 'data' => ''));exit;
                }else{
                    $this->db->trans_rollback();
                    echo json_encode(array('state' => false, 'msg' => '添加失败'.$res['msg'], 'data' => ''));exit;
                }
            }else{//编辑
                $where = "a.id = $id";
                $cols = "a.title,a.litpic";
                //查文章信息
                $res = $this->Articlem->getChannelArchivesInfo($where,$cols);
                if(!$res['state']) {
                    echo json_encode(array('state' => false, 'msg' =>'查询节点信息失败:'. $res['msg'], 'data' => ''));exit;
                }
                if(empty($res['data'])){
                    echo json_encode(array('state' => false, 'msg' =>'没有相关数据', 'data' => ''));exit;
                }
                $con = "编辑节点：".$res['data']['title'];
                $dpic = empty($picname)?"":$res['data']['litpic'];
                //++上传图片
                $path = "";
                if(!empty($picname)){//存在图片
                    //上传路径
                    // $name = $id.$pic_path['type']; //名称
                    $name = date ( 'YmdHis' ) . uniqid ('prefix')."_".$id.$pic_path['type'];
                    $folder = ROOTPATH . "data/".$pic_path['folder']."/"; //文件夹路径
                    if (!file_exists($folder)){ //不存在则创建文件夹
                        mkdir($folder);
                    }
                    $path = $folder.$name;
                    if (! move_uploaded_file($_FILES['article_litpic']['tmp_name'], $path)) {
                        echo json_encode(array('state'=>false,'msg'=>'上传图片失败，请稍后重新上传','data'=>''));exit;
                    }
                    $fpath = "/data/".$pic_path['folder']."/".$name;
                    //更新图片地址数组
                    $data1['litpic'] = $fpath;
                }

                $this->db->trans_begin();
                //更新相应表数据
                $res = $this->Articlem->editArticle($tables,$data1,$data2,"id = $id","aid = $id",$dpic);
                if($res['state']) {
                    $con = "修改节点：".$article_title;
                    $res = $this->System->logAction($con, __METHOD__);
                    if(!$res['state']) {
                        @unlink($path);//删除文件
                        $this->db->trans_rollback();
                        echo json_encode(array('state' => false, 'msg' =>'存修改日志失败:'. $res['msg'], 'data' => ''));exit;
                    }
                    $this->db->trans_commit();
                    echo json_encode(array('state' => true, 'msg' => '修改成功', 'data' => ''));exit;
                }else{
                    @unlink($path);//删除文件
                    $this->db->trans_rollback();
                    echo json_encode(array('state' => false, 'msg' => '修改失败'.$res['msg'], 'data' => ''));exit;
                }
            } 
        }else{//页面
            $id=isset($_GET['id'])?$_GET['id']:false;//编辑时传的id
            if($id) {//编辑
                $where = "a.id = $id";
                $cols = "a.title,a.shorttitle,a.flag,a.label,a.weight,a.typeid,a.litpic,a.keywords,a.description,a.click,a.pubdate,a.arcrank,c.body";
                //查节点信息
                $res = $this->Articlem->getArchivesAddInfo($where,$cols);
                if(!$res['state']) {
                    echo json_encode(array('state' => false, 'msg' =>'查询节点信息失败:'. $res['msg'], 'data' => ''));exit;
                }
                $data = $res['data'];
                if(empty($data)){
                    echo json_encode(array('state' => false, 'msg' =>'没有相关数据', 'data' => ''));exit;
                }
                $this->smarty->assign('article', $data);
                $this->smarty->assign('id', $id);
            }else{
                //查所属栏目,便于前台展示
                $res = $this->Articlem->getDisplayColumn("c.nid='node'",'a.id');
                if(!$res['state']) {
                    echo json_encode(array('state' => false, 'msg' =>'查询节点信息失败:'. $res['msg'], 'data' => ''));exit;
                }
                $data = $res['data'];
                $article = [];
                if(!empty($data)){
                    $article['typeid'] = $data['id'];
                    $this->smarty->assign('article', $article);
                }
            }
            //查栏目数据
            $column=$this->Articlem->getColumn();
            if(isset($column['state'])&&!$column['state']) {
                $this->System->showMessage('查询栏目出错:'.$column['msg']);
            }
            $this->smarty->assign('column',$column);

            $this->smarty->display('articleNode.html');
        }
    }
    // =======================================================激励=====================================================================
    /**
     * 激励
     * @author: wl
     */
    public function bounty() {
        $this->System->isPriv("bounty"); //权限
        if($_POST){
            $curpage=isset($_POST["start"]) ? $_POST["start"]:0;
            $rp  =isset($_POST["length"]) ? $_POST["length"]:50;
            $tag = isset($_POST['tag']) ? $_POST['tag'] : ''; 
            $searchType=isset($_POST['searchType']) && !empty($_POST['searchType']) ? $_POST['searchType'] : '';//搜索类型
            $searchVal=isset($_POST['searchVal']) && !empty($_POST['searchVal']) ? $_POST['searchVal'] : '';//搜索内容
            //后台排序
            $orderArr = isset($_POST['order']) ? $_POST['order'] : '';
            $sortType = "asc";
            $sortName = "t.sortrank,a.weight";
            if(!empty($orderArr)){
                if(!isset($orderArr[1])){
                    $sortType = $orderArr[0]['dir'];
                    switch ($orderArr[0]['column']){
                        case '1':
                            $sortName = "t.sortrank,a.weight";
                            break;
                        case '2':
                            $sortName = "a.title";
                            break;
                        case '3':
                            $sortName = "t.typename";
                            break;
                        case '4':
                            $sortName = "a.shorttitle";
                            break;
                        case '5':
                            $sortName = "a.source";
                            break;
                        case '6':
                            $sortName = "a.source";//状态
                            break;
                        case '7':
                            $sortName = "add.leader";//项目负责人
                            break;
                        default:
                            $sortName = "t.sortrank,a.weight";
                    }
                } 
            } 
            $where = "c.nid = 'bounty'"." and a.source='$tag'";//查模型为激励的数据（nid = bounty）
            if(!empty($searchVal)){
            	if($searchType == "project"){//项目名称
            		$where .= " and a.title like '%$searchVal%'";
            	}else if ($searchType == "author") {//作者
            		$where .= " and a.writer like '%$searchVal%'";
            	}else if ($searchType == "leader") {//负责人
            		$where .= " and leader like '%$searchVal%'";
            	}
            }
            $cols = "a.id,a.title,t.typename,a.shorttitle,a.click,a.source,a.writer,c.mancon,c.addcon,c.id cid,leader";
            $res = $this->Articlem->getArchives($where,$cols, $curpage, $rp, $sortName, $sortType);
            if(!$res['state']) {
                echo json_encode(array('state' => false, 'msg' => '查询出错:'.$res['msg'], 'data' => ''));exit;
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
            $tag=isset($_GET['tag']) ? $_GET['tag'] : "";//点击左侧栏类型
            $this->smarty->assign("tag",$tag);
            $this->smarty->display('bounty.html');
        } 
    }
    /**
     * 激励删除
     * @author: wl
     */
    public function bounty_del(){
        $this->System->isPriv("bounty_del"); //权限
        $this->news_del();
    }
     /***
     * 激励添加 
     * @author: wl
     ***/
    public function  bounty_add(){
        $this->System->isPriv("bounty_add"); //权限
        if ($_POST) {//编辑或者添加
            $postData = $this->input->post();
            $id = isset($postData['article_id'])?$postData['article_id']:"";
            $article_title = isset($postData['article_title'])?$postData['article_title']:"";
            $article_typeid = isset($postData['article_typeid'])?$postData['article_typeid']:"";
            $article_source = isset($postData['article_source'])?$postData['article_source']:""; 

            if(empty($article_title)||empty($article_typeid)||empty($article_source)){
                echo json_encode(array('state' => false, 'msg' => '参数错误', 'data' => ''));exit;
            }
            $data1 = [];//主表数据
            $data2 = [];//附表数据

            $data1['title'] = !empty($postData['article_title'])?$postData['article_title']:'';//项目名称
            $data1['shorttitle'] = !empty($postData['article_shorttitle'])?$postData['article_shorttitle']:'';//项目金额
            $data1['flag'] = !empty($postData['article_flag'])?implode(',',$postData['article_flag']):'';//自定义属性
            $data1['label'] = !empty($postData['article_label'])?$postData['article_label']:'';//标签
            $data1['weight'] = !empty($postData['article_weight'])?$postData['article_weight']:'';//权重
            $data1['typeid'] = $article_typeid;//栏目ID
            $data1['source'] = $article_source;//这里是指状态
            $data1['writer'] = !empty($postData['article_writer'])?$postData['article_writer']:'';//作者
            $data1['keywords'] = !empty($postData['article_keywords'])?$postData['article_keywords']:'';//关键字
            $data1['description'] = !empty($postData['article_description'])?$postData['article_description']:'';//内容摘要
            $data1['click'] = !empty($postData['article_click'])?$postData['article_click']:'';//浏览次数
            $data1['pubdate'] = !empty($postData['article_pubdate'])?strtotime($postData['article_pubdate']):'';//发布时间
            $data1['arcrank'] = !empty($postData['article_arcrank'])?$postData['article_arcrank']:'';//阅读权限

            $data2['redirecturl'] = !empty($postData['redirecturl'])?$postData['redirecturl']:'';//跳转地址
            $data2['leader'] = !empty($postData['leader']) ? $postData['leader']:'';//项目负责人
            $data2['typeid'] = !empty($postData['article_typeid'])?$postData['article_typeid']:'';//栏目ID
            $data2['body'] = !empty($postData['add_body'])?$postData['add_body']:'';//内容
            $tables = ['archives','addonarticle'];

            //++保存图片
            $pic_path = [];
            $picname = isset($_FILES['article_litpic']['name'])?$_FILES['article_litpic']['name']:'';
            //===================================== Mr zhang =====================================start
            $article_hidden = isset($postData['article_hidden'])?$postData['article_hidden']:"";//选择之后影藏的文件路径
            if(!empty($article_hidden)){//已选择文件  
        		if($article_hidden=="file"){//点击选择上传文件
	                $tmp_name = isset($_FILES['article_litpic']['tmp_name'])?$_FILES['article_litpic']['tmp_name']:'';
	                $img_info = getimagesize($tmp_name); 
	                $type = strstr($picname, '.');//判断文件格式
            	}else{
            		$type = strstr($article_hidden, '.');//判断文件格式
            	} 
                if ($type!='.png'&&$type!='.svg'&&$type!='.jpg') {
                    echo json_encode(array('state'=>false,'msg'=>'请上传png/svg/jpg格式图片','data'=>''));exit;
                }
                $pic_path['type'] = $type;//后缀
                $pic_path['folder'] = 'articles';//规定放哪个文件夹 
                $pic_path['choose']=$article_hidden;// Mr zhang添加 
	        }
	        //===================================== Mr zhang =====================================end 
            if(empty($id)){//添加 
                $this->db->trans_begin();
                //添加激励、附表、图片数据
                $res = $this->Articlem->addArticle($tables,$data1,$data2,$pic_path);
                if($res['state']) {
                    $dpath = $res['data'];
                    $con = "添加激励：".$article_title;
                    $res = $this->System->logAction($con, __METHOD__);
                    if(!$res['state']) {
                        @unlink($dpath);//删除文件
                        $this->db->trans_rollback();
                        echo json_encode(array('state' => false, 'msg' =>'存添加日志失败:'. $res['msg'], 'data' => ''));exit;
                    }
                    $this->db->trans_commit();
                    echo json_encode(array('state' => true, 'msg' => '添加成功', 'data' => ''));exit;
                }else{
                    $this->db->trans_rollback();
                    echo json_encode(array('state' => false, 'msg' => '添加失败'.$res['msg'], 'data' => ''));exit;
                }
            }else{//编辑 
                $where = "a.id = $id";
                $cols = "a.title,a.litpic";
                //查文章信息
                $res = $this->Articlem->getChannelArchivesInfo($where,$cols);
                $unlick=isset($res['data']['litpic']) && !empty($res['data']['litpic'])? ROOTPATH .$res['data']['litpic'] : "";
                if(!$res['state']) {
                    echo json_encode(array('state' => false, 'msg' =>'查询激励信息失败:'. $res['msg'], 'data' => ''));exit;
                }
                if(empty($res['data'])){
                    echo json_encode(array('state' => false, 'msg' =>'没有相关数据', 'data' => ''));exit;
                }
                $con = "编辑激励：".$res['data']['title'];
                $dpic = empty($picname)?"":$res['data']['litpic']; 
                //++上传图片
                $path = "";
                 
                if(!empty($article_hidden)){//存在图片
                    //上传路径
                    // $name = $id.$pic_path['type']; //名称
                    $name = date ( 'YmdHis' ) . uniqid ('prefix')."_".$id.$pic_path['type'];
                    $folder = ROOTPATH . "data/".$pic_path['folder']."/"; //文件夹路径
                    if (!file_exists($folder)){ //不存在则创建文件夹
                        mkdir($folder);
                    }
                    $path = $folder.$name; 
                    if($article_hidden=="file"){
		                if (! move_uploaded_file($_FILES['article_litpic']['tmp_name'], $path)) {
		                    echo json_encode(array('state'=>false,'msg'=>'上传图片失败，请稍后重新上传','data'=>''));exit;
		                }
	                }else{ 
	                	@unlink($unlick);//删除原有文件
	                	$dir=ROOTPATH.$article_hidden;//原有文件名称
	                	$res=copy($dir,$path);//$path：新文件的名称
		            	if(!$res){
		            		$this->db->trans_rollback();
		            		echo json_encode(array('state'=>false,'msg'=>'更新（复制）文章图片地址出错','data'=>''));exit;
		            	}
	                }
                    $fpath = "/data/".$pic_path['folder']."/".$name;
                    //更新图片地址数组
                    $data1['litpic'] = $fpath;
                } 
                $this->db->trans_begin();
                //更新相应表数据
                $res = $this->Articlem->editArticle($tables,$data1,$data2,"id = $id","aid = $id",$dpic);
                if($res['state']) {
                    $con = "修改激励：".$article_title;
                    $res = $this->System->logAction($con, __METHOD__);
                    if(!$res['state']) {
                        @unlink($path);//删除文件
                        $this->db->trans_rollback();
                        echo json_encode(array('state' => false, 'msg' =>'存修改日志失败:'. $res['msg'], 'data' => ''));exit;
                    }
                    $this->db->trans_commit();
                    echo json_encode(array('state' => true, 'msg' => '修改成功', 'data' => ''));exit;
                }else{
                    @unlink($path);//删除文件
                    $this->db->trans_rollback();
                    echo json_encode(array('state' => false, 'msg' => '修改失败'.$res['msg'], 'data' => ''));exit;
                }
            } 
        }else{//页面
            $id=isset($_GET['id'])?$_GET['id']:false;//编辑时传的id
            if($id) {//编辑
                $where = "a.id = $id";
                $cols = "a.title,a.shorttitle,a.flag,a.label,a.weight,a.typeid,a.litpic,a.source,a.writer,a.keywords,a.description,a.click,a.pubdate,a.arcrank,c.body,c.redirecturl,leader";
                //查激励信息
                $res = $this->Articlem->getArchivesAddInfo($where,$cols);
                if(!$res['state']) {
                    echo json_encode(array('state' => false, 'msg' =>'查询激励信息失败:'. $res['msg'], 'data' => ''));exit;
                }
                $data = $res['data'];
                if(empty($data)){
                    echo json_encode(array('state' => false, 'msg' =>'没有相关数据', 'data' => ''));exit;
                }
                //var_dump($data);
                $this->smarty->assign('article', $data);
                $this->smarty->assign('id', $id);
            }else{
                //查所属栏目,便于前台展示
                $res = $this->Articlem->getDisplayColumn("c.nid='bounty'",'a.id');
                if(!$res['state']) {
                    echo json_encode(array('state' => false, 'msg' =>'查询激励信息失败:'. $res['msg'], 'data' => ''));exit;
                }
                $data = $res['data'];
                $article = [];
                if(!empty($data)){
                    $article['typeid'] = $data['id'];
                    $this->smarty->assign('article', $article);
                }
                $tag=isset($_GET['tag']) ? $_GET['tag'] : "";
                $this->smarty->assign("tag",$tag);
            }
            //查栏目数据
            $column=$this->Articlem->getColumn();
            if(isset($column['state'])&&!$column['state']) {
                $this->System->showMessage('查询栏目出错:'.$column['msg']);
            }
            $this->smarty->assign('column',$column);

            $this->smarty->display('articleBounty.html');
        }
    }
    // =======================================================DAPP=====================================================================
    /**
     * DAPP
     * @author: wl
     */
    public function dapp() {
        $this->System->isPriv("dapp"); //权限
        if($_POST){
            $curpage=isset($_POST["start"]) ? $_POST["start"]:0;
            $rp  =isset($_POST["length"]) ? $_POST["length"]:50;
            //后台排序
            $orderArr = isset($_POST['order']) ? $_POST['order'] : '';
            $sortType = "asc";
            $sortName = "t.sortrank,a.weight";
            if(!empty($orderArr)){
                if(!isset($orderArr[1])){
                    $sortType = $orderArr[0]['dir'];
                    switch ($orderArr[0]['column']){
                        case '1':
                            $sortName = "t.sortrank,a.weight";
                            break;
                        case '2':
                            $sortName = "a.title";
                            break;
                        case '3':
                            $sortName = "t.typename";
                            break;
                        case '4':
                            $sortName = "a.shorttitle";
                            break;
                        case '5':
                            $sortName = "a.click";
                            break;
                        default:
                            $sortName = "t.sortrank,a.weight";
                    }
                } 
            }
            $where = "c.nid = 'dapp'";//查模型为DAPP的数据（nid = dapp）
            $cols = "a.id,a.title,t.typename,a.shorttitle,a.source,a.click,c.mancon,c.addcon,c.id cid";
            $res = $this->Articlem->getArchives($where,$cols, $curpage, $rp, $sortName, $sortType);
            if(!$res['state']) {
                echo json_encode(array('state' => false, 'msg' => '查询出错:'.$res['msg'], 'data' => ''));exit;
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
            $this->smarty->display('dapp.html');
        } 
    }
    /**
     * DAPP删除
     * @author: wl
     */
    public function dapp_del(){
        $this->System->isPriv("dapp_del"); //权限
        $this->news_del();
    }
     /***
     * DAPP添加
     * @author: wl
     ***/
    public function  dapp_add(){
        $this->System->isPriv("dapp_add"); //权限
        if ($_POST) {//编辑或者添加
            $postData = $this->input->post();
            $id = isset($postData['article_id'])?$postData['article_id']:"";
            $article_title = isset($postData['article_title'])?$postData['article_title']:"";
            $article_typeid = isset($postData['article_typeid'])?$postData['article_typeid']:"";
            // var_dump($_FILES);
            // var_dump($postData);die;
            if(empty($article_title)||empty($article_typeid)){
                echo json_encode(array('state' => false, 'msg' => '参数错误', 'data' => ''));exit;
            }
            $data1 = [];//主表数据
            $data2 = [];//附表数据

            $data1['title'] = !empty($postData['article_title'])?$postData['article_title']:'';//DAPP名称
            $data1['shorttitle'] = !empty($postData['article_shorttitle'])?$postData['article_shorttitle']:'';//地区
            $data1['flag'] = !empty($postData['article_flag'])?implode(',',$postData['article_flag']):'';//自定义属性
            $data1['label'] = !empty($postData['article_label'])?$postData['article_label']:'';//标签
            $data1['weight'] = !empty($postData['article_weight'])?$postData['article_weight']:'';//权重
            $data1['typeid'] = $article_typeid;//栏目ID
            $data1['source'] = !empty($postData['article_source'])?$postData['article_source']:'';//来源
            $data1['writer'] = !empty($postData['article_writer'])?$postData['article_writer']:'';//作者
            $data1['keywords'] = !empty($postData['article_keywords'])?$postData['article_keywords']:'';//关键字
            $data1['description'] = !empty($postData['article_description'])?$postData['article_description']:'';//内容摘要
            $data1['click'] = !empty($postData['article_click'])?$postData['article_click']:'';//浏览次数
            $data1['pubdate'] = !empty($postData['article_pubdate'])?strtotime($postData['article_pubdate']):'';//发布时间
            $data1['arcrank'] = !empty($postData['article_arcrank'])?$postData['article_arcrank']:'';//阅读权限

            $data2['typeid'] = !empty($postData['article_typeid'])?$postData['article_typeid']:'';//栏目ID
            $data2['body'] = !empty($postData['add_body'])?$postData['add_body']:'';//内容
            $tables = ['archives','addonarticle'];

            //++保存图片
            $pic_path = [];
            $picname = isset($_FILES['article_litpic']['name'])?$_FILES['article_litpic']['name']:'';
            if (!empty($picname)) {
                $tmp_name = isset($_FILES['article_litpic']['tmp_name'])?$_FILES['article_litpic']['tmp_name']:'';
                $img_info = getimagesize($tmp_name);
                // if($img_info[0]>55){
                //     echo json_encode(array('state'=>false,'msg'=>'宽度超过上限，请更换图片尺寸','data'=>''));exit;
                // }
                // if($img_info[1]>55){
                //     echo json_encode(array('state'=>false,'msg'=>'高度超过上限，请更换图片尺寸','data'=>''));exit;
                // }
                //判断文件格式
                $type = strstr($picname, '.');
                if ($type!='.png'&&$type!='.svg'&&$type!='.jpg') {
                    echo json_encode(array('state'=>false,'msg'=>'请上传png/svg格式图片','data'=>''));exit;
                }
                $pic_path['type'] = $type;//后缀
                $pic_path['folder'] = 'articles';//规定放哪个文件夹
            }
            
            // var_dump($id);die;
            if(empty($id)){//添加
                $this->db->trans_begin();
                //添加DAPP、附表、图片数据
                $res = $this->Articlem->addArticle($tables,$data1,$data2,$pic_path);
                if($res['state']) {
                    $dpath = $res['data'];
                    $con = "添加DAPP：".$article_title;
                    $res = $this->System->logAction($con, __METHOD__);
                    if(!$res['state']) {
                        @unlink($dpath);//删除文件
                        $this->db->trans_rollback();
                        echo json_encode(array('state' => false, 'msg' =>'存添加日志失败:'. $res['msg'], 'data' => ''));exit;
                    }
                    $this->db->trans_commit();
                    echo json_encode(array('state' => true, 'msg' => '添加成功', 'data' => ''));exit;
                }else{
                    $this->db->trans_rollback();
                    echo json_encode(array('state' => false, 'msg' => '添加失败'.$res['msg'], 'data' => ''));exit;
                }
            }else{//编辑
                $where = "a.id = $id";
                $cols = "a.title,a.litpic";
                //查文章信息
                $res = $this->Articlem->getChannelArchivesInfo($where,$cols);
                if(!$res['state']) {
                    echo json_encode(array('state' => false, 'msg' =>'查询DAPP信息失败:'. $res['msg'], 'data' => ''));exit;
                }
                if(empty($res['data'])){
                    echo json_encode(array('state' => false, 'msg' =>'没有相关数据', 'data' => ''));exit;
                }
                $con = "编辑DAPP：".$res['data']['title'];
                $dpic = empty($picname)?"":$res['data']['litpic'];
                //++上传图片
                $path = "";
                if(!empty($picname)){//存在图片
                    //上传路径
                    // $name = $id.$pic_path['type']; //名称
                    $name = date ( 'YmdHis' ) . uniqid ('prefix')."_".$id.$pic_path['type'];
                    $folder = ROOTPATH . "data/".$pic_path['folder']."/"; //文件夹路径
                    if (!file_exists($folder)){ //不存在则创建文件夹
                        mkdir($folder);
                    }
                    $path = $folder.$name;
                    if (! move_uploaded_file($_FILES['article_litpic']['tmp_name'], $path)) {
                        echo json_encode(array('state'=>false,'msg'=>'上传图片失败，请稍后重新上传','data'=>''));exit;
                    }
                    $fpath = "/data/".$pic_path['folder']."/".$name;
                    //更新图片地址数组
                    $data1['litpic'] = $fpath;
                }

                $this->db->trans_begin();
                //更新相应表数据
                $res = $this->Articlem->editArticle($tables,$data1,$data2,"id = $id","aid = $id",$dpic);
                if($res['state']) {
                    $con = "修改DAPP：".$article_title;
                    $res = $this->System->logAction($con, __METHOD__);
                    if(!$res['state']) {
                        @unlink($path);//删除文件
                        $this->db->trans_rollback();
                        echo json_encode(array('state' => false, 'msg' =>'存修改日志失败:'. $res['msg'], 'data' => ''));exit;
                    }
                    $this->db->trans_commit();
                    echo json_encode(array('state' => true, 'msg' => '修改成功', 'data' => ''));exit;
                }else{
                    @unlink($path);//删除文件
                    $this->db->trans_rollback();
                    echo json_encode(array('state' => false, 'msg' => '修改失败'.$res['msg'], 'data' => ''));exit;
                }
            } 
        }else{//页面
            $id=isset($_GET['id'])?$_GET['id']:false;//编辑时传的id
            if($id) {//编辑
                $where = "a.id = $id";
                $cols = "a.title,a.shorttitle,a.source,a.flag,a.label,a.weight,a.typeid,a.litpic,a.keywords,a.description,a.click,a.pubdate,a.arcrank,c.body";
                //查DAPP信息
                $res = $this->Articlem->getArchivesAddInfo($where,$cols);
                if(!$res['state']) {
                    echo json_encode(array('state' => false, 'msg' =>'查询DAPP信息失败:'. $res['msg'], 'data' => ''));exit;
                }
                $data = $res['data'];
                if(empty($data)){
                    echo json_encode(array('state' => false, 'msg' =>'没有相关数据', 'data' => ''));exit;
                }
                $this->smarty->assign('article', $data);
                $this->smarty->assign('id', $id);
            }else{
                //查所属栏目,便于前台展示
                $res = $this->Articlem->getDisplayColumn("c.nid='dapp'",'a.id');
                if(!$res['state']) {
                    echo json_encode(array('state' => false, 'msg' =>'查询DAPP信息失败:'. $res['msg'], 'data' => ''));exit;
                }
                $data = $res['data'];
                $article = [];
                if(!empty($data)){
                    $article['typeid'] = $data['id'];
                    $this->smarty->assign('article', $article);
                }
            }
            //查栏目数据
            $column=$this->Articlem->getColumn();
            if(isset($column['state'])&&!$column['state']) {
                $this->System->showMessage('查询栏目出错:'.$column['msg']);
            }
            $this->smarty->assign('column',$column);
            //查文章来源数据
            $res=$this->Articlem->getGroupArchives('1=1','source');
            if(isset($res['state'])&&!$res['state']) {
                $this->System->showMessage('查询文章来源出错:'.$res['msg']);
            }
            $this->smarty->assign('source',$res['data']);
             //查文章作者数据
            $res=$this->Articlem->getGroupArchives('1=1','writer');
            if(isset($res['state'])&&!$res['state']) {
                $this->System->showMessage('查询文章作者出错:'.$res['msg']);
            }
            $this->smarty->assign('writer',$res['data']);

            $this->smarty->display('articleDapp.html');
        }
    }

    /**
	*方法说明：Bounty导出数据
	*@param:Mr zhang
    **/
    public function export()
    {
        $this->System->isPriv("export"); //权限
    	require_once ROOTPATH . '/libraries/PHPExcel.php'; 
    	$objPHPExcel = new PHPExcel();
    	$objPHPExcel->getProperties()->setCreator('jk')
			->setLastModifiedBy('jk')
			->setTitle('Office 2007 XLSX Document')
			->setSubject('Office 2007 XLSX Document')
			->setDescription('Document for Office 2007 XLSX, generated using PHP classes.')
			->setKeywords('office 2007 openxml php')
			->setCategory('Result file'); 
		
    	$tag=isset($_GET['tag']) && !empty($_GET['tag']) ? $_GET['tag'] : "";//操作类型
    	$searchType=isset($_GET['searchType']) && !empty($_GET['searchType']) ? $_GET['searchType'] : '';//搜索类型
        $searchVal=isset($_GET['searchVal']) && !empty($_GET['searchVal']) ? $_GET['searchVal'] : '';//搜索内容
    	$where = "c.nid = 'bounty'"." and a.source='$tag'";//查模型为激励的数据（nid = bounty）
    	if(!empty($searchVal)){
        	if($searchType == "project"){//项目名称
        		$where .= " and a.title like '%$searchVal%'";
        	}else if ($searchType == "author") {//作者
        		$where .= " and a.writer like '%$searchVal%'";
        	}else if ($searchType == "leader") {//负责人
        		$where .= " and leader like '%$searchVal%'";
        	}
        }
        $cols = "a.id,a.title,t.typename,a.shorttitle,a.click,a.source,a.writer,c.mancon,c.addcon,c.id cid,a.pubdate,add.leader";
        $res = $this->Articlem->getExportArchives($where,$cols);
        if(!$res['state']) {
        	$this->System->showMessage('查询出错:'.$res['msg']);
        }
		$list=$res['data'];

		$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A1', 'index')
		->setCellValue('B1', 'project name')
		->setCellValue('C1', 'column')
		->setCellValue('D1', 'bonus')
		->setCellValue('E1', 'read frequency')
		->setCellValue('F1', 'status')
		->setCellValue('G1', 'author')
		->setCellValue('H1', 'leader')
		->setCellValue('I1', 'release date');
		$i = 2;
		foreach ($list as $k => $v) {
			$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A' . $i, ++$k)
				->setCellValue('B' . $i, $v['title'])
				->setCellValue('C' . $i, $v['typename'])
				->setCellValue('D' . $i, $v['shorttitle'])
				->setCellValue('E' . $i, $v['click'])
				->setCellValue('F' . $i, $v['source'])
				->setCellValue('G' . $i, $v['writer'])
				->setCellValue('H' . $i, $v['leader']) 
				->setCellValue('I' . $i, date('Y-m-d H:i:s', $v['pubdate']));
			$i++;
		}
		//============设置单元格宽度============start
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
		//============设置单元格宽度============end 
		$objPHPExcel->getActiveSheet()->setTitle('bounty');//工作空间sheet名称
		$objPHPExcel->setActiveSheetIndex(0);
		if($tag == "Active"){
			$name=urlencode("Active");
		}elseif ($tag == "InProgress") {
			$name=urlencode("InProgress");
		}elseif ($tag == "Done") {
			$name=urlencode("Done");
		}else {
			$name=urlencode("Closed");
		}
		$filename = $name . date('YmdHis');
		ob_end_clean();
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$aaa = $objWriter->save('php://output');
        exit; 
    }
}
?>