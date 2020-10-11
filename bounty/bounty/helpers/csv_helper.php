<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * csv_get_lines 导入CSV文件中的某几行数据
 * @param $csvfile csv文件路径
 * @param $lines 读取行数
 * @param $offset 起始行数
 * @return array
 * */
function csv_import($csvfile, $lines, $offset =0) {

    if(!$fp = fopen($csvfile, 'r')) {
        return false;
    }
    $i = $j = 0;
    while (false !== ($line = fgets($fp))) {
        if($i++ < $offset) {
            continue;
        }
        break;
    }
    $data = array();
    while(($j++ < $lines) && !feof($fp)) {
        $data[] = fgetcsv($fp);
    }
//    $data = mb_convert_encoding($data, "UTF-8", "GBK");
    fclose($fp);
    return $data;
}
//调用方法
//$data = csv_get_lines('path/bigfile.csv', 10, 2000000);
//print_r($data);

/**
 * 导出csv文件
 * @param  $data 导出的数据
 * @param  $titleList  导出数据的标题行
 * @param  $fileName  导出的名字
 * @return  csv文件
 **/
function csv_export($data, $titleList = array(), $fileName = '')
{
    ini_set("max_execution_time", "3600");
    $csvData = '';
// 标题
    $nums = count($titleList);
    for ($i = 0; $i < $nums - 1; $i++)
    {
        $csvData .= '"' . $titleList[$i] . '",';
    }
    $csvData .= '"' . $titleList[$nums - 1] . "\"\r\n";
    foreach ($data as $key => $row)
    {
        $i = 0;
        foreach ($row as $_key => $_val)
        {
            $_val = str_replace("\"", "\"\"", $_val);
            if ($i < ($nums - 1))
            {
                $csvData .= '"' . $_val . '",';
            }
            elseif ($i == ($nums - 1))
            {
                $csvData .= '"' . $_val . "\"\r\n";
            }
            $i++;
        }
        unset($data[$key]);
    }
    $csvData = mb_convert_encoding($csvData, "GBK", "UTF-8");
    $fileName = empty($fileName) ? date('Y-m-d-H-i-s', time()) : $fileName;
    $fileName = $fileName . '.csv';
    header("Content-type:text/csv;");
    header("Content-Disposition:attachment;filename=" . $fileName);
    header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
    header('Expires:0');
    header('Pragma:public'); 
    echo $csvData;
    die();
}