<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
class UserbaseController extends BaseController {
	public function __construct(){
		parent::__construct();  //调用父构造函数避免冲突
		if(empty($_SESSION['uid']) or !isset($_SESSION['uid'])){
            if(IS_AJAX){
				$data['status']=0;
				$data['msg']="请您先登录";
				$this->ajaxReturn($data);
			}else{
				$this->redirect("login/login");
			}
        }
        //一小时内未付款订单设为取消
        // $order=M('order')->where('aid ='.$_SESSION['uid'].' AND status = 1 ')->select();
        // foreach($order as $k=>$v){
        //     if(time() > $order[$k]['addtime']+3600){
        //         M("Order")->where("id=".$order[$k]['id'])->setField('status',-1);
        //     }
        // }
        $user = M("User")->where("id = ".$_SESSION['uid'])->find();
        $this->user = $user;
        $this->config = M("Config")->where("id = 1")->find();
        $this->assign('user',$user);
        //签到
        $sign = M("sign")->where("uid = ".$_SESSION['uid'])->find();
        $this->sign = $sign;
	}

}
