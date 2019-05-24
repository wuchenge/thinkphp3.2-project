<?php
// 本类由系统自动生成，仅供测试用途
namespace 	Home\Controller;
use Think\CommController\Controller;
class ContactController extends Controller {
	public function index(){
		$list = M("honor")->order('addtime desc')->select();
		$this->assign("list",$list);
		$this->display();
	}
    //我要合作
    public function ti(){
        if(IS_POST){
            $val=array(
                array('name','require','请填写联系人',1),
                array('company','require','请填写公司名称',1),
                array('tel','require','请填写联系电话',1),
                array('tel', '/^\d{11}$/', '联系电话格式不正确！', 1, 'regex', 3),
                array('address','require','请填写地址',1),
                array('email','require','请填写邮箱',1),
                array('yixiang','require','请填写意向',1),
                array('text','require','请填写留言',1),
            );
            if($data=M('message')->validate($val)->create()){
                $log='';
                $log['name']=I("post.name");//网点类型id
                $log['company']=I("post.company");
                $log['tel']=I("post.tel");
                $log['address']=I("post.address");
                $log['email']=I("post.email");
                $log['yixiang']=I("post.yixiang");
                $log['text']=I("post.text");
                $log['addtime']=time();
                $result=M('message')->add($log);
                if($result){
                    $data['stu'] = 1;
                    $data['msg'] = "填写信息添加成功";
                    $this->ajaxReturn($data);
                }else{
                    $data['stu']=0;
                    $data['msg']="填写信息添加失败";
                    $this->ajaxReturn($data);
                }
            }else{
                $data['stu']=0;
                $data['msg']=M('message')->getError();
                $this->ajaxReturn($data);
            }
        }else{   
            $this->display();
        }
    }
}