<?php
namespace Admin\Controller;
use Think\Controller;
class MemberController extends Controller {
	/**
	*	会员列表
	*/
    public function memberList(){
        $this->display("member/memberList");
    }
	
}