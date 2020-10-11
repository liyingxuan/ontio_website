<?php
/**
 * public function Class
 *公共函数类
 * @leeyoung
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Publicfun
{
    protected $CI;

    // We'll use a constructor, as you can't directly call a function
    // from a property definition.
    public function __construct()
    {
        // Assign the CodeIgniter super-object
        $this->CI =& get_instance();
    }
   /**
    * 产生一个订单号
    * @param  int  $userId 用户ID号
    * @return number
    * @author 李洋
    */
   public function createOrderSn($userId,$unid=false){
       $mCode = array('A','B','C','D','E','F','G','H','I','J','K','L');
       $yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'K','M','N','L');
       $dCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'K','M','N','L','O','P','Q','R','S','T','U','V','W','X','Y','Z','1','2','3','4','5','6');
       $u_id = sprintf('%03d', (int) $userId % 1000);
       if($unid)
       {
       	 $uunid=substr($unid,-8,8);
       }else
       {
       	  $uunid=substr(uniqid(),5,8);
       }
       $orderSn=$yCode[intval(date('Y')) - 2018].$mCode[intval(date('m'))].$dCode[intval(date('d'))].$u_id.$uunid.sprintf('%02d', (float) microtime() * 100).mt_rand(10,99);
       return $orderSn;
   }

   /**
    * 生成支付单编号(两位随机 + 从2000-01-01 00:00:00 到现在的秒数+微秒+会员ID%1000)，该值会传给第三方支付接口
    * 长度 =2位 + 10位 + 3位 + 3位  = 18位
    * 1000个会员同一微秒提订单，重复机率为1/100
    * @param  int  $user_id  用户ID好号
    * @return string
    * @author 李洋
    */
   public function createPaySn($user_id) {
       return mt_rand(10,99)
       . sprintf('%010d',time() - 946656000)
       . sprintf('%03d', (float) microtime() * 1000)
       . sprintf('%03d', (int) $user_id % 1000);
   }
   /**
    * 生成售后单号
    * 长度 = 5位 + 3位  = 8位
    * @param  int  $user_id  用户ID号
    * @return string
    * @author 吴龙
    */
   public function createAsaleSn($user_id) {
       return substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 5)
       .sprintf('%03d', (int) $user_id % 1000);
   }
    /**
    * 生成二维码不带LOGO
    * @param  int  $user_id  用户ID好号
    * @return string
    * @author 李洋
    */
   public function createQrCode($content,$filename,$level='L',$pointSize='9') {
   	    require_once "Com/phpqrcode.php";
        $data =$content;  
		$filename = $filename;  //  生成的文件名  
		$errorCorrectionLevel = $level;  // 纠错级别：L、M、Q、H  
		$matrixPointSize = $pointSize; // 点的大小：1到10  
		QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
		return    $filename;
   }

    /**
     * 文件上传
     * @param $field  上传文件的字段名
     * @param $path   上传文件的存放路径
     * @param array $allowtype  上传文件允许类型
     * @param int $maxsize   上传文件的限制最大上传限制
     * @param bool $israndname  文件是否随机命名  true:重新随机命名  false:不重新命名
     * @return array
     * @author mzm
     */
   public function uploadsFile($field,$path,$israndname=false,$allowtype=array('jpg','gif','png','jpeg','bmp'),$maxsize = 1048576){
       if(is_string($field) && is_string($path)){
           require_once "libraries/FileUpload.php";
           $fp = new FileUpload();
           $fp->set("path",$path)->set("allowtype",$allowtype)->set("maxsize",$maxsize)->set("israndname",$israndname);
           $res = $fp->upload($field);
           if($res){
               $file_name = $fp->getFileName(); //文件上传之后的 文件名
               $url = $path.$file_name;
               return  array('state'=>true,'msg'=>'图片上传成功','data'=>$url);
           }else{
               $msg =$fp->getErrorMsg();
               return array('state'=>false,'msg'=>'图片上传失败','data'=>$msg);
           }
       }else{
           return array('state'=>false,'msg'=>'参数错误','data'=>'');
       }
   }
   /**
    * 生成随机数和字母组成的字符串(默认取四位)
    * @return sting
    * @author 吴龙
    */
    public function mtRandStr($len=4){
        $chars_array = array(
            "0", "1", "2", "3", "4", "5", "6", "7", "8", "9",
            "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k",
            "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v",
            "w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G",
            "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R",
            "S", "T", "U", "V", "W", "X", "Y", "Z",
        );
        $charsLen = count($chars_array) - 1;
        $outputstr = "";
        for ($i=0; $i<$len; $i++)
        {
            $outputstr .= $chars_array[mt_rand(0, $charsLen)];
        }
        return $outputstr;
    }
    /**
    * 根据时间戳判断日期，输出不同的结果
    * @param timeStamp 时间戳
    * @return sting
    * @author 吴龙
    */
    public function getTimeStr($timeStamp){
        //php获取今日开始时间戳和结束时间戳
        $beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));
        $endToday=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;

        //php获取昨日起始时间戳
        $beginYesterday=mktime(0,0,0,date('m'),date('d')-1,date('Y'));

        //php获取本周起始时间戳
        $beginLastweek=mktime(0,0,0,date('m'),date('d')-date('w')+1,date('Y'));

        //php获取本年起始时间戳
        $beginYear = mktime(0,0,0,1,1,date('Y'));

        $endThismonth=mktime(23,59,59,date('m'),date('t'),date('Y'));
        if($timeStamp >= $beginToday && $timeStamp <= $endToday){
            // return array('desc'=>'今天','time'=>date('H:i:s',$timeStamp));
            return array('desc'=>'','time'=>date('H:i',$timeStamp));
        }elseif($timeStamp >= $beginYesterday && $timeStamp < $beginToday){
            return array('desc'=>'昨天','time'=>date('H:i',$timeStamp));
        }elseif($timeStamp >= $beginLastweek && $timeStamp < $beginYesterday){
            $weekday = array('周日','周一','周二','周三','周四','周五','周六'); 
            $str = $weekday[date("w", $timeStamp)];
            return array('desc'=>$str,'time'=>date('H:i',$timeStamp));
        }elseif($timeStamp >= $beginYear && $timeStamp < $beginLastweek){
            return array('desc'=>date('Y-m-d',$timeStamp),'time'=>date('m-d H:i',$timeStamp));
        }elseif($timeStamp < $beginYear){
            return array('desc'=>date('Y-m-d',$timeStamp),'time'=>date('Y-m-d H:i',$timeStamp));
        }
    }
}
?>
