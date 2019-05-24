<?php
// 本类由系统自动生成，仅供测试用途
namespace 	Home\Controller;
use Think\CommController\Controller;
class AddressController extends UserbaseController {
	//地址
    public function index(){
        $id = I("id");
        if(!empty($id)){
            $addr = M("Address")->where("id = ".$id." and uid = ".$_SESSION['uid'])->find();
            if($addr){
                $this->assign('addr',$addr);
            }else{
                $this->error('没有该数据');
            }
        }
        $where['uid'] = $_SESSION['uid'];
        $address = M("address")->where($where)->order("is_default desc,addtime desc")->select();
        $this->assign('address',$address);
        $top="地址管理";
        $this->assign('top',$top);
        $this->assign('s',$s);
        $this->display();
    }
	//修改地址
	public function xiu(){
		$id = I("post.id");
		$addr = M("address")->where("id = ".$id." and uid = ".$_SESSION['uid'])->find();
		$data['addr']=$addr;
		$this->ajaxReturn($data);
	}
    //确认订单中的修改地址
    public function changeadd(){
        $id=I('get.id');
        $result=M('address')->where('id ='.$id)->find();
        if(!empty($result)){
            $data['status']=1;
            $data['name']=$result['name'];
            $data['province']=$result['province'];
            $data['city']=$result['city'];
            $data['address']=$result['address'];
            $data['tel']=$result['tel'];
            $data['is_default']=$result['is_default'];
            $data['id']=$result['id'];
            $this->ajaxReturn($data);
        }else{
            $data['status']=0;
            $data['msg']="该地址不存在";
            $this->ajaxReturn($data);
        }
    }

    //地址保存实现
    public function doaddr(){
        if(empty($_POST['name'])){
            $data['status'] = 0;
            $data['msg'] = "请输入收货人";
            $this->ajaxReturn($data);
        }
        if(empty($_POST['sheng']) || empty($_POST['shi']) || empty($_POST['address'])){
            $data['status'] = 0;
            $data['msg'] = "请输入完整的收货地址";
            $this->ajaxReturn($data);
        }
        if(!preg_match("/^1[3|4|5|7|8][0-9]\d{8}$/",$_POST['tel'])){
            $data['status'] = 0;
            $data['msg'] = "请输入正确的手机号码！";
            $this->ajaxReturn($data);
        }
        $id = trim(I("post.id"));
        if(empty($id)){
            $addr = M("address");
            $addr->create();
            $addr->addtime = time();
            $addr->uid = $_SESSION['uid'];
            if(empty($_POST['is_default'])){
                $addr->is_default = -1;
            }else{
                $addr->is_default = 1;
            }
            $result = $addr->add();
            if($result){
                if(!empty($_POST['is_default'])){
                    M("address")->where("id!=".$result." and uid = ".$_SESSION['uid'])->setField('is_default',-1);
                }
                $data['status'] = 1;
                $data['msg'] = "新增成功！";
                $this->ajaxReturn($data);
            }else{
                $data['status'] = 0;
                $data['msg'] = "新增失败！";
                $this->ajaxReturn($data);
            }
        }else{
            $address = M("address")->where("id = ".$id." and uid = ".$_SESSION['uid'])->find();
            if(empty($address)){
                $data['status'] = 0;
                $data['msg'] = "该数据不存在";
                $this->ajaxReturn($data);
            }
            $addr = M("address");
            $addr->create();
            if(empty($_POST['is_default'])){
                $addr->is_default = -1;
            }else{
                $addr->is_default = 1;
            }
            
            $result = $addr->save();
            if($result !== false){
                if(!empty($_POST['is_default'])){
                    M("address")->where("id != ".$id." and uid=".$_SESSION['uid'])->setField('is_default',-1);
                }
                $data['status'] = 1;
                $data['msg'] = "修改成功！";
                $this->ajaxReturn($data);
            }else{
                $data['status'] = 0;
                $data['msg'] = "修改失败！";
                $this->ajaxReturn($data);
            }
        }
    }

    //地址删除
    public function addrdel(){
        $id = I("id");
        $address = M("address")->where("id = ".$id." and uid = ".$_SESSION['uid'])->find();
        if($address){
            $result = M("address")->where("id = ".$id)->delete();
            if($result){
                $data['status'] = 1;
                $data['msg'] = "删除成功！";
                $this->ajaxReturn($data);
            }else{
                $data['status'] = 0;
                $data['msg'] = "删除失败，请稍候操作";
                $this->ajaxReturn($data);
            }
        }else{
            $data['status'] = 0;
            $data['msg'] = "要删除的数据不存在";
            $this->ajaxReturn($data);
        }
    }

}