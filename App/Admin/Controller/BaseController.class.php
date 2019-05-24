<?php
namespace Admin\Controller;
use Think\Controller;
class BaseController extends Controller {
	public function _initialize(){
		if(empty($_SESSION['adminid']) or !isset($_SESSION['adminid'])){
			$url = U('login/login');
			echo "<script>top.location.href='".$url."';</script>";
		}
		$gla=M('admin')->find($_SESSION['adminid']);
		$glb=M('role')->find($gla['qid']);
		$this->assign('glb',$glb);
		if($glb['is_one']!=1){
			$glb['quanxian']=strtolower($glb['quanxian']);
			$glb['quanxian']=explode(',',$glb['quanxian']);
			$a=strtolower(CONTROLLER_NAME);
			$b=strtolower(ACTION_NAME);
			$c=$a.'-'.$b;
			if(!in_array($c,$glb['quanxian'])){
				echo "<script>alert('您没有权限');</script>";
				$url = U('index/index');
				echo "<script>top.location.href='".$url."';</script>";
			}
		}
	}
	/**
	*	AJax 成功返回
	*/
	public function ok($status = 1, $msg = "操作成功"){
		echo json_encode(array("status"=>$status , "info"=>$msg));
		exit;
	}
	/**
	*	AJax 失败返回
	*/
	public function wrong($msg = "操作失败"){
		echo json_encode(array("status"=>0 , "info"=>$msg));
		exit;
	}
}