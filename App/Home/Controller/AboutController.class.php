<?php
// 本类由系统自动生成，仅供测试用途
namespace 	Home\Controller;
use Think\CommController\Controller;
class AboutController extends BaseController {
	public function index(){
		$list = M("honor")->order('addtime desc')->select();
		$this->assign("list",$list);
		$this->display();
	}

}