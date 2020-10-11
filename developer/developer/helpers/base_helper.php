<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 递归方式的对变量中的特殊字符进行转义
 *
 * @param mixed $value
 * @return mixed
 */
function addslashes_deep($value) {
    if (empty ( $value )) {
        return $value;
    } else {
        return is_array ( $value ) ? array_map ( 'addslashes_deep', $value ) : addslashes ( $value );
    }
}

/**
 * 读结果缓存文件
 *
 * @param string $cache_name
 * @return array $data
 */
function read_static_cache($cache_name) {
    if ((DEBUG_MODE & 2) == 2) {
        return false;
    }
    static $result = array ();
    if (! empty ( $result [$cache_name] )) {
        return $result [$cache_name];
    }
    $cache_file_path = ROOTPATH . '/temp/static_caches/' . $cache_name . '.php';
    if (file_exists ( $cache_file_path )) {
        include_once ($cache_file_path);
        $result [$cache_name] = $data;
        return $result [$cache_name];
    } else {
        return false;
    }
}

/**
 * 写结果缓存文件
 *
 * @param string $cache_name
 * @param string $caches
 */
function write_static_cache($cache_name, $caches) {
    if ((DEBUG_MODE & 2) == 2) {
        return false;
    }
    $cache_file_path = ROOTPATH . '/temp/static_caches/' . $cache_name . '.php';
    $content = "<?php\r\n";
    $content .= "\$data = " . var_export ( $caches, true ) . ";\r\n";
    $content .= "?>";
    file_put_contents ( $cache_file_path, $content, LOCK_EX );
}

/**
 * 获得用户的真实IP地址
 *
 * @access public
 * @return string
 */
function real_ip() {
    static $realip = NULL;
    if ($realip !== NULL) {
        return $realip;
    }
    if (isset ( $_SERVER )) {
        if (isset ( $_SERVER ['HTTP_X_FORWARDED_FOR'] )) {
            $arr = explode ( ',', $_SERVER ['HTTP_X_FORWARDED_FOR'] );
            /* 取X-Forwarded-For中第一个非unknown的有效IP字符串 */
            foreach ( $arr as $ip ) {
                $ip = trim ( $ip );
                if ($ip != 'unknown') {
                    $realip = $ip;
                    break;
                }
            }
        } elseif (isset ( $_SERVER ['HTTP_CLIENT_IP'] )) {
            $realip = $_SERVER ['HTTP_CLIENT_IP'];
        } else {
            if (isset ( $_SERVER ['REMOTE_ADDR'] )) {
                $realip = $_SERVER ['REMOTE_ADDR'];
            } else {
                $realip = '0.0.0.0';
            }
        }
    } else {
        if (getenv ( 'HTTP_X_FORWARDED_FOR' )) {
            $realip = getenv ( 'HTTP_X_FORWARDED_FOR' );
        } elseif (getenv ( 'HTTP_CLIENT_IP' )) {
            $realip = getenv ( 'HTTP_CLIENT_IP' );
        } else {
            $realip = getenv ( 'REMOTE_ADDR' );
        }
    }
    preg_match ( "/[\d\.]{7,15}/", $realip, $onlineip );
    $realip = ! empty ( $onlineip [0] ) ? $onlineip [0] : '0.0.0.0';
    return $realip;
}

/**
 * 获取本地ip地址
 */
function get_client_ip() {
    if ($_SERVER ['REMOTE_ADDR']) {
        $cip = $_SERVER ['REMOTE_ADDR'];
    } elseif (getenv ( "REMOTE_ADDR" )) {
        $cip = getenv ( "REMOTE_ADDR" );
    } elseif (getenv ( "HTTP_CLIENT_IP" )) {
        $cip = getenv ( "HTTP_CLIENT_IP" );
    } else {
        $cip = "unknown";
    }
    return $cip;
}

/**
 * 验证邮件地址是否合法
 *
 * @param string $email
 * @return bool
 */
function is_email($email) {
    $chars = "/^([a-z0-9+_]|\\-|\\.)+@(([a-z0-9_]|\\-)+\\.)+[a-z]{2,6}\$/i";
    if (strpos ( $email, '@' ) !== false && strpos ( $email, '.' ) !== false) {
        if (preg_match ( $chars, $email )) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

/**
 * 验证手机号是否合法
 */
function is_mobile($mobile) {
    if (! is_numeric ( $mobile )) {
        return false;
    }
    return preg_match ( '#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#', $mobile ) ? true : false;
}

/**
 * 固话验证
 * @param unknown $mobile
 * @return boolean
 */
function is_tel($mobile) {
    if (! is_numeric ( $mobile )) {
        return false;
    }
    return preg_match ( '#^(0\d{2,3}(\-)?)?\d{7,8}$#', $mobile ) ? true : false;
}

/**
 * 验证价格是否正确
 */
function is_price($price) {
    return preg_match('#^(0|[1-9][0-9]{0,9})(\.[0-9]{1,2})?$#', $price) ? true : false;
}
/**
 * 规范化ajax返回json数据结构
 *
 * @param boolean	$status		ajax返回状态
 * @param mix		$data		ajax返回数据
 * @param string	$msg		ajax返回信息
 * @param array		$extra		ajax附加项
 */
function ajax_json_return($status = false, $data = '', $msg = '', $extra = null) {
    $return = array (
        'status' => $status,
        'data' => $data,
        'msg' => $msg
    );
    if (is_array ( $extra )) {
        foreach ( $extra as $k => $v ) {
            if ($k !== 'status' && $k !== 'data' && $k !== 'msg')
                $return [$k] = $v;
        }
    }
    echo json_encode ( $return );
    exit ();
}

/**
 * 系统提示信息
 *
 * @param       string      msg_detail      消息内容
 * @param       int         msg_type        消息类型， 0消息，1错误，2询问
 * @param       array       links           可选的链接
 * @param       boolen      $auto_redirect  是否需要自动跳转
 * @return      void
 */


/**
 * 加密密码
 *
 * @param string $pwd
 * @return string
 */
function encrypt_pwd($pwd) {
    return md5 ( strrev ( md5 ( $pwd ) ) );
}

/**
 * 获取资源路径.
 *
 * @param string $path 相对项目根目录路径
 * @return string 返回url 如：www.host.net/data/unknown.jpg
 */
function resource_url($path) {
    
    $path = (strpos ( $path, '/' ) == 0 && strpos ( $path, '/' ) !== false) ? substr ( $path, 1 ) : $path; // 去掉路径的开头的/
    return 'http://' . $_SERVER ['HTTP_HOST'] . str_replace ( $_SERVER ['DOCUMENT_ROOT'], '', str_replace ( 'system/helpers/base_helper.php', '', str_replace ( '\\', '/', __FILE__ ) ) ) . $path;
}

/**
 * 将一维数组连接，如array(1,2,3) => '1,2,3'
 * @param unknown $glue
 * @param unknown $pieces
 * @return string
 */
function implode_unique($glue, $pieces){
    $pieces = array_unique($pieces);
    foreach ($pieces as $k => $v){
        if(empty($v)){
            unset($pieces[$k]);
        }
    }
    return implode($glue, $pieces);
}

/**
 * 移除字符串的多余的符号，如'1,2,3,,2,5' => '1,2,3,5'
 * @param unknown $glue
 * @param unknown $string
 * @return string
 */
function remove_extra_tag($glue,$string){
    $pieces = explode($glue, $string);
    return implode_unique($glue, $pieces);
}


/**
 * 判断管理员对某一个操作是否有权限.
 *
 * 根据当前对应的action_code，然后再和用户session里面的action_list做匹配，以此来决定是否可以继续执行。
 * @param string $priv_str 操作对应的priv_str
 */
function admin_priv_json($priv_str) {
    global $_LANG;
    if (! admin_priv ( $priv_str, false )) {
        ajax_json_return ( false, '', $_LANG ['priv_error'] );
    }
}
/**
 * 创建像这样的查询: "IN('a','b')";
 *
 * @access   public
 * @param    mix      $item_list      列表数组或字符串
 * @param    string   $field_name     字段名称
 *
 * @return   void
 */
function db_create_in($item_list, $field_name = '')
{
    if (empty($item_list))
    {
        return $field_name . " IN ('') ";
    }
    else
    {
        if (!is_array($item_list))
        {
            $item_list = explode(',', $item_list);
        }
        $item_list = array_unique($item_list);
        $item_list_tmp = '';
        foreach ($item_list AS $item)
        {
            if ($item !== '')
            {
                $item_list_tmp .= $item_list_tmp ? ",'$item'" : "'$item'";
            }
        }
        if (empty($item_list_tmp))
        {
            return $field_name . " IN ('') ";
        }
        else
        {
            return $field_name . ' IN (' . $item_list_tmp . ') ';
        }
    }
}

/**
 *  清除指定后缀的模板缓存或编译文件
 *
 * @access  public
 * @param  bool       $is_cache  是否清除缓存还是清除编译文件
 * @param  string     $ext       需要删除的文件名，不包含后缀
 *
 * @return int        返回清除的文件个数
 */
function clear_tpl_files($is_cache = true, $ext = '')
{
    $dirs = array();

    $tmp_dir = 'temp';

    if ($is_cache)
    {
        $cache_dir = ROOTPATH . $tmp_dir . '/caches/';
        $dirs[] = ROOTPATH . $tmp_dir . '/query_caches/';
        $dirs[] = ROOTPATH . $tmp_dir . '/static_caches/';
        for($i = 0; $i < 16; $i++)
        {
            $hash_dir = $cache_dir . dechex($i);
            $dirs[] = $hash_dir . '/';
        }
    }
    else
    {
        $dirs[] = ROOTPATH . $tmp_dir . '/compiled/';
        $dirs[] = ROOTPATH . $tmp_dir . '/compiled/admin/';
        $dirs[] = ROOTPATH . $tmp_dir . '/compiled/biz/';
    }

    $str_len = strlen($ext);
    $count   = 0;

    foreach ($dirs AS $dir)
    {
        $folder = @opendir($dir);

        if ($folder === false)
        {
            continue;
        }

        while ($file = readdir($folder))
        {
            if ($file == '.' || $file == '..' || $file == 'index.htm' || $file == 'index.html')
            {
                continue;
            }
            if (is_file($dir . $file))
            {
                /* 如果有文件名则判断是否匹配 */
                $pos = ($is_cache) ? strrpos($file, '_') : strrpos($file, '.');

                if ($str_len > 0 && $pos !== false)
                {
                    $ext_str = substr($file, 0, $pos);

                    if ($ext_str == $ext)
                    {
                        if (@unlink($dir . $file))
                        {
                            $count++;
                        }
                    }
                }
                else
                {
                    if (@unlink($dir . $file))
                    {
                        $count++;
                    }
                }
            }
        }
        closedir($folder);
    }

    return $count;
}
/**
 * 清除缓存文件
 *
 * @access  public
 * @param   mix     $ext    模版文件名， 不包含后缀
 * @return  void
 */
function clear_cache_files($ext = '')
{
    return clear_tpl_files(true, $ext);
}
/**
 * 将上传文件转移到指定位置
 *
 * @author k
 *
 * @param string $file_name
 * @param string $target_name
 * @return blog
 */
function move_upload_file($file_name, $target_name = '')
{
    if (function_exists("move_uploaded_file"))
    {
        if (move_uploaded_file($file_name, $target_name))
        {
            @chmod($target_name,0755);
            return true;
        }
        else if (copy($file_name, $target_name))
        {
            @chmod($target_name,0755);
            return true;
        }
    }
    elseif (copy($file_name, $target_name))
    {
        @chmod($target_name,0755);
        return true;
    }
    return false;
}
/**
 * 解析json数据成数组
 * @$param 为json数据
 */
function jsonToArray($param,$isneed = true,$default = array())
{
    $paramArr = @json_decode($param,true);//转成数组
    $default=null;
    if(is_array($paramArr)){
        return $paramArr;
    }else{
        if($isneed){
            echo '{$key}没有传';
        }
        return $default;
    }
}
/** 科学计数法转化为数值
 * @string  $num     科学计数数值
 * @return  string   转化成功的字符串
 * @author   gjd
 */
function NumToStr($num){
    if (stripos($num,'e')===false) return $num;
    $num = trim(preg_replace('/[=\'"]/','',$num,1),'"');//出现科学计数法，还原成字符串
    $str = "";
    while ($num > 0){
        $v = $num - floor($num / 10)*10;
        $num = floor($num / 10);
        $str   =   $v . $str;
    }
    return $str;
}

/**
* 记录日志
* @param string $file  文件名
* @param string $data  日志内容
* @author 李洋
*/
function diylog($file,$data,$status){
    $file_path = ROOTPATH . 'logs/'.$file;
    if($status){
    	file_put_contents($file_path, date('Y-m-d H:i:s').$data.PHP_EOL,FILE_APPEND);
    } 
}

//CURL请求(直接返回结果)
function httpRequest($url,$data = null){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    if (!empty($data)){
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
}

?>