<?php
require_once('crop.php');

$src = 'upload/2015/11/14/14474844558026.jpg';
//$src = $_GET['src'];
$rs = explode(".",$src);
$ext = strtolower($rs[count($rs)-1]);
$type = array('jpg', 'jpeg', 'png');
$path = sprintf('%s/%s/%s/', date('Y'), date('m'), date('d'));

$fileName = time() . rand(1000, 9999) . '.' . $ext;
$fullName = $path . $fileName;	
$path = rtrim('upload', DIRECTORY_SEPARATOR) . '/' . $fullName;
$path2 = "/Public/avatar/".$path;
$crop = new App_Util_Crop();
//$crop->initialize($src, $path, $_GET['x'], $_GET['y'], 200, 200, $_GET['w'], $_GET['h']);
$crop->initialize($src, $path, 26, 0, 200, 200, 200, 200);
$success = $crop->generate_shot();
//print_r($success);
$msg = $success ? '裁剪成功' : '裁剪失败';
echo $msg;
exit;
echo json_encode(array('result' => $success, 'msg' => $msg, 'src' => $path2));
//print_r($success);