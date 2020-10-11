<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Articlem extends CI_Model{
	public function __construct()
    {
        $this->load->database();
        $this->load->language('common');
    }
    /**
     * 获取单个栏目信息.
     * @param  string $where 查询条件
     * @return 1，参数异常：返回false数组 2，正常：返回true数组
     * @author  吴龙
     */ 
    public function getArctype($where,$cols='*'){
        if(is_string($where)&&is_string($cols))
        {
            $res=$this->db->select($cols)->from('arctype')->where($where)->get()->row_array();
            $error = $this->db->error();
            if(!empty($error['code'])){
                return array('state' => false,'msg'=>"查询错误:".$error['code'].$error['message'],'data'=>'');die;
            }
            return array('state' => true,'msg'=>'查询成功','data'=>$res);
        }else{
            return array('state' => false,'msg'=>'方法参数错误,需要字符串','data'=>'');
        }  
    }
    // /**
    //  * 获取单个栏目信息.
    //  * @param  string $where 查询条件
    //  * @return 1，参数异常：返回false数组 2，正常：返回true数组
    //  * @author  吴龙
    //  */ 
    // public function getArctype($where,$cols='*'){
    //     if(is_string($where)&&is_string($cols))
    //     {
    //         $res=$this->db->select($cols)->from('arctype a')->join('channeltype c','c.id=a.channeltype','left')->where($where)->get()->row_array();
    //         $error = $this->db->error();
    //         if(!empty($error['code'])){
    //             return array('state' => false,'msg'=>"查询错误:".$error['code'].$error['message'],'data'=>'');die;
    //         }
    //         return array('state' => true,'msg'=>'查询成功','data'=>$res);
    //     }else{
    //         return array('state' => false,'msg'=>'方法参数错误,需要字符串','data'=>'');
    //     }  
    // }
    /**
     * 获取内容模型
     * @param  string $where 查询条件
     * @return 1，参数异常：返回false数组 2，正常：返回true数组
     * @author  吴龙
     */
    public function getChanneltype($where,$cols='*')
    {
    	if(is_string($where)&&is_string($cols))
        {
	        $res=$this->db->select($cols)->from('channeltype')->where($where)->get()->result_array();
	        if (!empty($error['code'])) {
	            return array('state' => false, 'msg' => "查询错误:" . $error['code'] . $error['message'], 'data' => '');
	            die;
	        }
	        return array('state' => true, 'msg' => '查询成功', 'data' => $res);
	    }else{
            return array('state' => false,'msg'=>'方法参数错误,需要字符串','data'=>'');
        }
    }
    /**
     * 获取内容模型
     * @param  string $where 查询条件
     * @return 1，参数异常：返回false数组 2，正常：返回true数组
     * @author  吴龙
     */
    public function getLanguage($where,$cols='*')
    {
    	if(is_string($where)&&is_string($cols))
        {
	        $res=$this->db->select($cols)->from('language')->where($where)->get()->result_array();
	        if (!empty($error['code'])) {
	            return array('state' => false, 'msg' => "查询错误:" . $error['code'] . $error['message'], 'data' => '');
	            die;
	        }
	        return array('state' => true, 'msg' => '查询成功', 'data' => $res);
	    }else{
            return array('state' => false,'msg'=>'方法参数错误,需要字符串','data'=>'');
        }
    }
    /**
     * 获取所有文章列表.
     * @param  string $where 查询条件
     * @return 1，参数异常：返回false数组 2，正常：返回true数组
     * @author  吴龙
     */ 
    public function getArchives($where,$cols='*',$curpage=1,$rp=40,$sortname='t.sortrank,a.weight',$sortorder='asc'){
        if(is_string($where)&&is_string($cols))
        {
            $this->db->select($cols)->from('archives a')->join('arctype t','t.id=a.typeid','left')->join('language g','g.lgid=a.lgid','left')->join('admin m','m.admin_id=a.dutyadmin','left')->join('channeltype c','c.id=t.channeltype','left')->join('addonarticle add','add.aid=a.id','left')->where($where);
            $db=clone($this->db);
            $count=$this->db->count_all_results();
            $this->db=$db;
            $this->db->group_by('a.id');
            $this->db->order_by($sortname,$sortorder);
            $this->db->limit($rp,$curpage);
            $res=$this->db->get()->result_array();
             //echo $this->db->last_query();
            $error = $this->db->error();
            if(!empty($error['code'])){
                return array('state' => false,'msg'=>"查询错误:".$error['code'].$error['message'],'data'=>'');die;
            }
            return array('state' => true,'msg'=>'查询成功','data'=>array('count'=>$count,'datas'=>$res));
        }else{
            return array('state' => false,'msg'=>'方法参数错误,需要字符串','data'=>'');
        }  
    }
    /**
     * 获取所有文章列表.(导出数据使用)
     * @param  string $where 查询条件
     * @return 1，参数异常：返回false数组 2，正常：返回true数组
     * @author  Mr  zhang
     */ 
    public function getExportArchives($where,$cols='*',$sortname='t.sortrank,a.weight',$sortorder='asc'){
        if(is_string($where)&&is_string($cols))
        {
            $this->db->select($cols)->from('archives a')->join('arctype t','t.id=a.typeid','left')->join('language g','g.lgid=a.lgid','left')->join('admin m','m.admin_id=a.dutyadmin','left')->join('channeltype c','c.id=t.channeltype','left')->join('addonarticle add','add.aid=a.id','left')->where($where); 
            $this->db->group_by('a.id');
            $this->db->order_by($sortname,$sortorder);
            $res=$this->db->get()->result_array();
            $error = $this->db->error();
            if(!empty($error['code'])){
                return array('state' => false,'msg'=>"查询错误:".$error['code'].$error['message'],'data'=>'');die;
            }
            return array('state' => true,'msg'=>'查询成功','data'=>$res);
        }else{
            return array('state' => false,'msg'=>'方法参数错误,需要字符串','data'=>'');
        }  
    }
    /**
     * 查不同栏目对应的内容：根据传的主副表查相应的表.
     * @param  array $tables 查询的表(主表、副表)
     * @param  string $where 查询条件
     * @param  string $cols 查询的字段
     * @return 1，参数异常：返回false数组 2，正常：返回true数组
     * @author  吴龙
     */ 
    public function getChannelArchives($tables,$where,$cols='*',$curpage=1,$rp=40,$sortname='id',$sortorder='desc'){
        if(is_array($tables)&&is_string($where)&&is_string($cols))
        {
        	if(isset($tables[1])){//存在副表
        		$this->db->select($cols)->from($tables[0])->join($tables[1],$tables[1].".aid=".$tables[0].".id",'left');
        	}else{
            	$this->db->select($cols)->from($tables[0]);
        	}
            $this->db->where($where);
            $db=clone($this->db);
            $count=$this->db->count_all_results();
            $this->db=$db;
            $this->db->group_by('a.id');
            $this->db->order_by($sortname,$sortorder);
            $this->db->limit($rp,$curpage);
            $res=$this->db->get()->result_array();
            $error = $this->db->error();
            if(!empty($error['code'])){
                return array('state' => false,'msg'=>"查询错误:".$error['code'].$error['message'],'data'=>'');die;
            }
            return array('state' => true,'msg'=>'查询成功','data'=>array('count'=>$count,'datas'=>$res));
        }else{
            return array('state' => false,'msg'=>'方法参数错误,需要字符串','data'=>'');
        }  
    }
    /**
     * 添加文章.
     * @param  array $tables 添加的表(主表、副表)
     * @param  array $data1 主表添加的数据
     * @param  array $data2 副表添加的数据
     * @param  array $pic_path 上传路径、名称等
     * @return 1，参数异常：返回false数组 2，正常：返回true数组
     * @author  吴龙
     */ 
    public function addArticle($tables,$data1,$data2,$pic_path=array()){
        if(is_array($data1)&&is_array($data2))
        { 
           	$this->db->insert($tables[0], $data1);
           	$id=$this->db->insert_id();
            $error = $this->db->error();
            if(!empty($error['code'])){
            	$this->db->trans_rollback();
                return array('state' => false,'msg'=>"添加文章出错:".$error['code'].$error['message'],'data'=>'');die;
            }
            $path = "";
            //===================================== Mr zhang =====================================edit start
            if(!empty($pic_path)){//已存再选择图片上传或事选择站点图片 
            	$name = date ( 'YmdHis' ) . uniqid ('prefix')."_".$id.$pic_path['type']; //名称 添加数据后+数据ID 便于以后删除
            	// $name = $id.$pic_path['type']; //名称
            	$folder = ROOTPATH . "data/".$pic_path['folder']."/"; //文件夹路径
		        if (!file_exists($folder)){ //不存在则创建文件夹
		            mkdir($folder);
		        }
		        $path = $folder.$name;
		        if($pic_path['choose']=="file"){
	                if (! move_uploaded_file($_FILES['article_litpic']['tmp_name'], $path)) {
	                    echo json_encode(array('state'=>false,'msg'=>'上传图片失败，请稍后重新上传','data'=>''));exit;
	                }
                }else{
                	$dir=ROOTPATH.$pic_path['choose'];//原有文件名称
                	$res=copy($dir,$path);
	            	if(!$res){
	            		$this->db->trans_rollback();
		                return array('state' => false,'msg'=>"更新（复制）文章图片地址出错:".$res,'data'=>'');die;
	            	}
                }
                $fpath = "/data/".$pic_path['folder']."/".$name;
            	//更新图片地址
            	$this->db->update($tables[0],array('litpic'=>$fpath),array('id'=>$id));
	            $error = $this->db->error();
	            if(!empty($error['code'])){
	            	@unlink($path);
	            	$this->db->trans_rollback();
	                return array('state' => false,'msg'=>"更新文章图片地址出错:".$error['code'].$error['message'],'data'=>'');die;
	            }
            }
            //===================================== Mr zhang =====================================edit end
            if(isset($tables[1])&&!empty($tables[1])){//存在副表
            	$data2['aid'] = $id;
            	// var_dump($data2);die;
           		$this->db->insert($tables[1], $data2);
           		$error = $this->db->error();
	            if(!empty($error['code'])){
	            	@unlink($path);
	            	$this->db->trans_rollback();
	                return array('state' => false,'msg'=>"添加文章副表数据出错:".$error['code'].$error['message'],'data'=>'');die;
	            }
        	}
            // $this->db->trans_commit();
            return array('state' => true,'msg'=>'添加成功','data'=>$path);
        }else{
            return array('state' => false,'msg'=>'方法参数错误,需要数组','data'=>'');
        }  
    }

    /**
     * 删除文章.
     * @param  array $tables 查询的表(主表、副表)
     * @param  string $where1 主表删除条件
     * @param  string $where2 副表删除条件
     * @param  string $litpic 图片地址
     * @return 1，参数异常：返回false数组 2，正常：返回true数组
     * @author  吴龙
     */ 
    public function delArticle($tables,$where1,$where2,$litpic=""){
        if(is_array($tables)&&is_string($where1)&&is_string($where2))
        {
        	// $this->db->trans_begin();
        	if(isset($tables[1])&&!empty($tables[1])){//存在副表
           		$this->db->where($where2)->delete($tables[1]);
           		$error = $this->db->error();
	            if(!empty($error['code'])){
	            	$this->db->trans_rollback();
	                return array('state' => false,'msg'=>"删除文章副表数据出错:".$error['code'].$error['message'],'data'=>'');die;
	            }
        	}
        	//删除图片
        	if(!empty($litpic)){
        		$litpic = ltrim($litpic,'/');
            	@unlink(ROOTPATH.$litpic);
            }
           	$this->db->where($where1)->delete($tables[0]);
            $error = $this->db->error();
            if(!empty($error['code'])){
            	$this->db->trans_rollback();
                return array('state' => false,'msg'=>"删除文章出错:".$error['code'].$error['message'],'data'=>'');die;
            }
            // $this->db->trans_commit();
            return array('state' => true,'msg'=>'删除成功','data'=>'');
        }else{
            return array('state' => false,'msg'=>'方法参数错误','data'=>'');
        }  
    }
    /**
     * 编辑文章.
     * @param  array $tables 查询的表(主表、副表)
     * @param  array $data1 主表要更新的数据
     * @param  array $data2 副表要更新的数据
     * @param  string $where1 条件
     * @param  string $where2 条件
     * @param  string $dpic 要删除的原图片
     * @return 1，参数异常：返回false数组 2，正常：返回true数组
     * @author  吴龙
     */ 
    public function editArticle($tables,$data1,$data2,$where1,$where2,$dpic=""){
        if(is_array($tables)&&is_array($data1)&&is_array($data2)&&is_string($where1)&&is_string($where2))
        {
        	// $this->db->trans_begin();
        	if(isset($tables[1])){//存在副表
           		$this->db->update($tables[1],$data2,$where2);
           		$error = $this->db->error();
	            if(!empty($error['code'])){
	            	$this->db->trans_rollback();
	                return array('state' => false,'msg'=>"更新文章副表数据出错:".$error['code'].$error['message'],'data'=>'');die;
	            }
        	}
        	//删除原图片
        	if(!empty($dpic)){
        		$dpic = ltrim($dpic,'/');
            	@unlink(ROOTPATH.$dpic);
            }
           	$this->db->update($tables[0],$data1,$where1);
            $error = $this->db->error();
            if(!empty($error['code'])){
            	$this->db->trans_rollback();
                return array('state' => false,'msg'=>"更新文章出错:".$error['code'].$error['message'],'data'=>'');die;
            }
            // $this->db->trans_commit();
            return array('state' => true,'msg'=>'更新成功','data'=>'');
        }else{
            return array('state' => false,'msg'=>'方法参数错误','data'=>'');
        }  
    }
    /**
     * 获取单个文章及其栏目信息.
     * @param  string $where 查询条件
     * @return 1，参数异常：返回false数组 2，正常：返回true数组
     * @author  吴龙
     */ 
    public function getChannelArchivesInfo($where,$cols='*'){
        if(is_string($where)&&is_string($cols))
        {
            $res=$this->db->select($cols)->from('archives a')->join('channeltype c','c.id=a.channel','left')->where($where)->get()->row_array();
            $error = $this->db->error();
            if(!empty($error['code'])){
                return array('state' => false,'msg'=>"查询错误:".$error['code'].$error['message'],'data'=>'');die;
            }
            return array('state' => true,'msg'=>'查询成功','data'=>$res);
        }else{
            return array('state' => false,'msg'=>'方法参数错误,需要字符串','data'=>'');
        }  
    }
    /**
     * 获取单个文章及其附表信息.
     * @param  string $where 查询条件
     * @return 1，参数异常：返回false数组 2，正常：返回true数组
     * @author  吴龙
     */ 
    public function getArchivesAddInfo($where,$cols='*'){
        if(is_string($where)&&is_string($cols))
        {
            $res=$this->db->select($cols)->from('archives a')->join('addonarticle c','a.id=c.aid','left')->where($where)->get()->row_array();
            $error = $this->db->error();
            if(!empty($error['code'])){
                return array('state' => false,'msg'=>"查询错误:".$error['code'].$error['message'],'data'=>'');die;
            }
            return array('state' => true,'msg'=>'查询成功','data'=>$res);
        }else{
            return array('state' => false,'msg'=>'方法参数错误,需要字符串','data'=>'');
        }  
    }
    /**
     * 获取栏目树
     * @param  string $where 附加查询条件,注意条件记得加上 and
     */
    public function getColumnList($pid = 0,$level = 0,$where="")
    {
        // $data = $this->db->select('reid,id,channeltype,typename,ispart')->order_by('sortrank')->where(array('reid' => $pid))->get('arctype')->result_array();
        $data = $this->db->select('a.reid,a.id,a.channeltype,a.language,a.typename,a.ispart,c.nid')->from('arctype a')->join('channeltype c','c.id=a.channeltype','left')->order_by('a.id desc,a.sortrank asc')->where("a.reid = $pid ".$where)->get()->result_array();
        $level++;
        $error = $this->db->error();
        if (!empty($error['code'])) {
            return array('state' => false, 'msg' => "查询错误!".$error['code'].$error['message'], 'data' => '');
        }
        if (!empty($data)) {
            $tree = array();
            foreach ($data as $val) {
                $child = $this->getColumnList($val['id'], $level);
                // $tree[] = array('self' => $val, 'child' => $child, 'level' => $level);
                $val['child'] = $child;
                $val['level'] = $level;
                $tree[] = $val;
            }
            return $tree;
        }
    }
    /**
     * 获取栏目树带字符--
     */
    public function getColumn($pid=0,&$arr=array(),$spac=0){
        $spac=$spac+4;
        $data = $this->db->select('reid,id,typename')->where(array('reid'=>$pid))->get('arctype')->result_array();
        $error = $this->db->error();
        if (!empty($error['code'])) {
            return array('state' => false, 'msg' => "查询错误!".$error['code'].$error['message'], 'data' => '');
        }
        if(!empty($data)){
            foreach ($data as $k=>$v){
                $v['typename']=str_repeat('&nbsp',$spac).'|--'.$v['typename'];
                $arr[]=$v;
                $this->getColumn($v['id'],$arr,$spac);
            }
        }
        return $arr;
    }
    /**
     * 获取文章来源|作者
     */
    public function getGroupArchives($where,$cols='*'){
        if(is_string($where)&&is_string($cols))
        {
            $res=$this->db->select($cols)->from('archives')->where($where)->group_by($cols)->get()->result_array();
            $error = $this->db->error();
            if(!empty($error['code'])){
                return array('state' => false,'msg'=>"查询错误:".$error['code'].$error['message'],'data'=>'');die;
            }
            return array('state' => true,'msg'=>'查询成功','data'=>$res);
        }else{
            return array('state' => false,'msg'=>'方法参数错误,需要字符串','data'=>'');
        }  
    }
    /**
     * 编辑栏目.
     * @param  string $where 查询条件
     * @param  array $data 更新内容
     * @param  string $dpic 原图片
     * @return 1，参数异常：返回false数组 2，正常：返回true数组
     */
    public function editArctype($data,$where,$dpic="")
    {
        if (is_array($data)&&is_string($where)) {
        	//删除原图片
        	if(!empty($dpic)){
        		$dpic = ltrim($dpic,'/');
            	@unlink(ROOTPATH.$dpic);
            }
            $res = $this->db->update('arctype', $data, $where);
            $error = $this->db->error();
            if (!empty($error['code'])) {
                return array('state' => false, 'msg' => "执行错误:" . $error['code'] . $error['message'], 'data' => '');
                die;
            }
            return array('state' => true, 'msg' => '执行成功', 'data' => '');
        } else {
            return array('state' => false, 'msg' => '参数错误', 'data' => '');
        }
    }
    /**
     * 添加栏目
     * @param  array $data 插入的数据
     * @param  array $pic_path 上传路径、名称等
     * @return 1，参数异常：返回false数组 2，正常：返回true数组
     */
    public function addArctype($data,$pic_path=array())
    {
        if (is_array($data)) {
            $this->db->insert('arctype', $data);
            $id=$this->db->insert_id();
            $error = $this->db->error();
            if (!empty($error['data'])) {
                return array('state' => false, 'msg' => "执行错误:" . $error['code'] . $error['message'], 'data' => '');
            }
            $path = "";
            if(!empty($pic_path)){//存在图片
            	//上传路径
            	$name = date ( 'YmdHis' ) . uniqid ('prefix')."_".$id.$pic_path['type']; //名称 添加数据后+数据ID 便于以后删除
            	// $name = $id.$pic_path['type']; //名称
            	$folder = ROOTPATH . "data/".$pic_path['folder']."/"; //文件夹路径
		        if (!file_exists($folder)){ //不存在则创建文件夹
		            mkdir($folder);
		        }
		        $path = $folder.$name;
                if (! move_uploaded_file($_FILES['data_icon']['tmp_name'], $path)) {
                    echo json_encode(array('state'=>false,'msg'=>'上传图片失败，请稍后重新上传','data'=>''));exit;
                }
                $fpath = "/data/".$pic_path['folder']."/".$name;
            	//更新图片地址
            	$this->db->update('arctype',array('icon'=>$fpath),array('id'=>$id));
	            $error = $this->db->error();
	            if(!empty($error['code'])){
	            	@unlink($path);
	            	$this->db->trans_rollback();
	                return array('state' => false,'msg'=>"更新栏目图片地址出错:".$error['code'].$error['message'],'data'=>'');die;
	            }
            }
            return array('state' => true, 'msg' => '执行成功', 'data' => $path);
        } else {
            return array('state' => false, 'msg' => '参数错误', 'data' => '');
        }
    }
    /**
     * 递归删除栏目及其图片
     * @param $id  删除条件:栏目id
     * @return 1，参数异常：返回false数组 2，正常：返回true数组
     * @author  吴龙
     */
    public function delArctype($id)
    {
        if (is_string($id)) {
            //查其图片地址数据
            $pic = $this->db->select('icon')->where(array('id' => $id))->get('arctype')->row_array();
            $error = $this->db->error();
            if (!empty($error['code'])) {
                $this->db->trans_rollback();
                return array('state' => false, 'msg' => "查询图片地址错误!".$error['code'].$error['message'], 'data' => '');
            }
            //删除图片
            $icon = $pic['icon'];
            if(!empty($icon)){
                $icon = ltrim($icon,'/');
                @unlink(ROOTPATH.$icon);
            }
        	//删除主数据
        	$this->db->where("id = $id")->delete('arctype');
            $error = $this->db->error();
            if (!empty($error['code'])) {
                $this->db->trans_rollback();
                return array('state' => false, 'msg' => "执行错误:" . $error['code'] . $error['message'], 'data' => '');
            }
            //查其自子数据
            $data = $this->db->select('reid,id')->where(array('reid' => $id))->get('arctype')->result_array();
            $error = $this->db->error();
            if (!empty($error['code'])) {
                $this->db->trans_rollback();
                return array('state' => false, 'msg' => "查询错误!".$error['code'].$error['message'], 'data' => '');
            }
	        if (!empty($data)) {
	            foreach ($data as $val) {
	                $this->delArctype($val['id']);
	            }
	        }
            return array('state' => true, 'msg' => '执行成功', 'data' => '');
        } else {
            return array('state' => false, 'msg' => '参数错误', 'data' => '');
        }
    }
    /**
     * 获取每个页面要选中的栏目
     */
    public function getDisplayColumn($where, $cols = "*")
    {
        if(is_string($where)&&is_string($cols))
        {
	        $res=$this->db->select($cols)->from('arctype a')->join('channeltype c','c.typename=a.typename','left')->where($where)->get()->row_array();
	        if (!empty($error['code'])) {
	            return array('state' => false, 'msg' => "查询错误:" . $error['code'] . $error['message'], 'data' => '');
	            die;
	        }
	        return array('state' => true, 'msg' => '查询成功', 'data' => $res);
	    }else{
            return array('state' => false,'msg'=>'方法参数错误,需要字符串','data'=>'');
        }
    }
}
?>