<?php
/**
     * 获取当前页面完整URL地址
     */
    function get_url()
    {
        $sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
        $php_self = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
        $path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
        $relate_url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $php_self.(isset($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING'] : $path_info);
        return $sys_protocal.(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '').$relate_url;
    }
    //后台分页
function adminpage($count, $pagesize = 10)
{
    $p = new Think\Page($count, $pagesize);
    $p->setConfig('header', '共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页');
    $p->setConfig('prev', '上一页');
    $p->setConfig('next', '下一页');
    $p->setConfig('last', '末页');
    $p->setConfig('first', '首页');
    $p->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
    $p->lastSuffix = false;//最后一页不显示为总页数
    return $p;
}
    //获取openid
  function openid($code)
  {
      //配置appid
      $appid = "wx5391175bb38ef6b6";
      //配置appscret
      $secret = "ff76aa91dc6955fd84e8fea6f0a51884";
         
      $url = 'https://api.weixin.qq.com/sns/jscode2session?appid='.$appid.'&secret='.$secret.'&js_code='.$code.'&grant_type=authorization_code';
      $info = file_get_contents($url);//get请求网址，获取数据
        $jsonObj = json_decode($info);//对json数据解码
        if (isset($jsonObj->errcode)) {
            //$result= json_encode(array("statusCode"=>0 , "data"=>null , "errMsg"=>$info));
            $result=array('status'=>0,'openid'=>'','mes'=>'发送失败');
        }
      $openid = $jsonObj->openid;
      //$session_key = $jsonObj->session_key;
      //$result= json_encode(array("statusCode"=>1 , "data"=>$openid , "errMsg"=>"success"));
      $result=array('status'=>1,'openid'=>$openid,'mes'=>'发送成功');
      return $result;
  }
     // function openid($code){
     //    //配置appid
     //    $appid = "wx5391175bb38ef6b6";
     //    //配置appscret
     //    $secret = "ff76aa91dc6955fd84e8fea6f0a51884";
     //    $url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$appid."&secret=".
     //         $secret."&code=".$code."&grant_type=authorization_code";
     //    $weixin=file_get_contents($url);//通过code换取网页授权access_token
     //    $jsondecode=json_decode($weixin); //对JSON格式的字符串进行编码
     //    $array = get_object_vars($jsondecode);//转换成数组
     //    $openid = $array['openid'];//输出openid
     //    $result=array('status'=>1,'openid'=>$openid,'mes'=>'发送成功');
     //    return $result;
     //   // return $openid;
     //  }
// 短信验证
function sendmail($mobil, $content)
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://platform.18sms.com/msg/send?user_name=Rf_cYpwREJ&password=h0F_4E1Su&phone=$mobil&sms_detail=$content&send_model=1&needstatus=2&product_type=1",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "{\n\t\"user_name\": \"Rf_cYpwREJ\",\n\t\"password\": \"h0F_4E1Su\",\n\t\"send_model\": 1,\n\t\"needstatus\": 2,\n\t\"product_type\": 1,\n\t\"phone\": \"$mobil\",\n\t\"sms_detail\": \"$content\"\n}",
    CURLOPT_HTTPHEADER => array(
      "Content-Type: application/json",
      "Postman-Token: b49e4a3f-1e0a-4a02-a219-b611e2cf31e4",
      "cache-control: no-cache"
    ),
  ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        $rm=array('status'=>0,'code'=>$code,'mes'=>$err);
        return $rm;
        //echo "cURL Error #:" . $err;
    } else {
        $rm=array('status'=>1,'code'=>$code,'mes'=>'发送成功');
        return $rm;
        //echo $response;
    }
}
function write_paylogs($filename, $content)
{
    $date = date('Y-m-d');
    $file = "./Public/paylog/".$date;
    if (!is_dir($file)) {
        mkdir($file);
    }
    $file = $file."/".$filename.".txt";
    //$content = "【收到信息".date("Y-m-d H:i:s",time())."】".$content."\r\n\r\n";
    $open=fopen($file, "a");
    fwrite($open, $content);
    fclose($open);
}

// 导出excel
 function push($data, $name='Excel')
 {
     vendor("PHPExcel.PHPExcel");
     error_reporting(E_ALL);
     date_default_timezone_set('Europe/London');
     $objPHPExcel = new PHPExcel();
     /*以下是一些设置 ，什么作者  标题啊之类的*/
     $objPHPExcel->getProperties()->setCreator("订单表")
                               ->setLastModifiedBy("订单表")
                               ->setTitle("数据EXCEL导出")
                               ->setSubject("数据EXCEL导出")
                               ->setDescription("订单数据")
                               ->setKeywords("excel")
                              ->setCategory("result file");
        
     foreach ($data as $k => $v) {
         $num=$k+2;
         $aaa = 1;

         //设置标题
         $objPHPExcel->setActiveSheetIndex(0);
         $objPHPExcel->getActiveSheet()->SetCellValue('A'.$aaa, '订单号');
         $objPHPExcel->getActiveSheet()->SetCellValue('B'.$aaa, '收货人');
         $objPHPExcel->getActiveSheet()->SetCellValue('C'.$aaa, '收货地址');
         $objPHPExcel->getActiveSheet()->SetCellValue('D'.$aaa, '收货人电话');
         $objPHPExcel->getActiveSheet()->SetCellValue('E'.$aaa, '产品名称');
         $objPHPExcel->getActiveSheet()->SetCellValue('F'.$aaa, '产品数量');
         $objPHPExcel->getActiveSheet()->SetCellValue('G'.$aaa, '产品规格');
         $objPHPExcel->getActiveSheet()->SetCellValue('H'.$aaa, '下单状态!');
         $objPHPExcel->getActiveSheet()->SetCellValue('I'.$aaa, '下单时间');
         $objPHPExcel->getActiveSheet()->SetCellValue('J'.$aaa, '订单总价');
         $objPHPExcel->getActiveSheet()->SetCellValue('K'.$aaa, '配送人');

         //这里是设置宽度
         // $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
         // $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
         $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
         $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
         $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(90);
         $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
         $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(90);
         $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
         $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(90);
         $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
         $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
         $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(30);
         $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(30);
         /*以下就是对处理Excel里的数据， 横着取数据，主要是这一步，其他基本都不要改*/
         $objPHPExcel->setActiveSheetIndex(0)
                          ->setCellValue('A'.$num, ' '.$v['orderid'])
                          ->setCellValue('B'.$num, ' '.$v['addressman'])
                          ->setCellValue('C'.$num, ' '.$v['address'])
                          ->setCellValue('D'.$num, ' '.$v['addressmobile'])
                          ->setCellValue('E'.$num, ' '.$v['gnames'])
                          ->setCellValue('F'.$num, ' '.$v['amount'])
                          ->setCellValue('G'.$num, ' '.$v['val'])
                          ->setCellValue('H'.$num, ' '.$v['zt'])
                          ->setCellValue('I'.$num, ' '.$v['addtime'])
                          ->setCellValue('J'.$num, ' '.$v['totalprice'])
                           ->setCellValue('J'.$num, ' '.$v['addressforeign']);
         ;
     }
     $objPHPExcel->getActiveSheet()->setTitle('User');
     $objPHPExcel->setActiveSheetIndex(0);
     header('Content-Type: application/vnd.ms-excel');
     header('Content-Disposition: attachment;filename="'.$name.'.xls"');
     header('Cache-Control: max-age=0');
     $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
     $objWriter->save('php://output');
     exit;
 }
