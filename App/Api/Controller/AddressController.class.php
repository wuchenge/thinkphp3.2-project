<?php
// 本类由系统自动生成，仅供测试用途
namespace Api\Controller;
use Think\Controller;
class AddressController extends Controller {
	//地址
    public function index(){
        $uid=I('post.uid');
        if(empty($uid)){
            $return['stu'] = '0';
            $return['code'] = '108';
            $return['msg'] = '缺少重要参数';
            $this->ajaxReturn($return);
        }else{
            $where['uid']=$uid;
        }
        $res['address']= M("address")->
                where($where)->
                order("addtime desc")->
                select();
        $return['stu'] = '1';
        $return['res'] = $res;
        $this->ajaxReturn($return);
    }
   //地址新增
    public function doadd(){
        if(empty($_POST['uid'])||empty($_POST['name'])||empty($_POST['tel'])||empty($_POST['sheng']) || empty($_POST['shi']) || empty($_POST['xian'])|| empty($_POST['address'])|| empty($_POST['youbian'])|| empty($_POST['biaoqian'])){
            $return['stu'] = '0';
            $return['code'] = '108';
            $return['msg'] = '缺少重要参数';
            $this->ajaxReturn($return);
        }
        if(!preg_match("/^1[3|4|5|7|8][0-9]\d{8}$/",$_POST['tel'])){
            $return['stu'] = '0';
            $return['code'] = '109';
            $return['msg'] = '请输入正确的手机号码！';
            $this->ajaxReturn($return);
        }
        $addr = M("address");
        $addr->create();
        $addr->addtime = time();
        $addr->uid = $_POST['uid'];
        $result = $addr->add();
        if($result){
            $return['stu'] = '1';
            $return['res'] = $result;
            $this->ajaxReturn($return);
        }else{
            $return['stu'] = '0';
            $return['code'] = '110';
            $return['msg'] = '地址添加失败';
            $this->ajaxReturn($return);
        }
    }
    //地址修改
    public function doedit(){
        if(empty($_POST['id'])||empty($_POST['uid'])||empty($_POST['name'])||empty($_POST['tel'])||empty($_POST['sheng']) || empty($_POST['shi']) || empty($_POST['xian'])|| empty($_POST['address'])|| empty($_POST['youbian'])|| empty($_POST['biaoqian'])){
            $return['stu'] = '0';
            $return['code'] = '108';
            $return['msg'] = '缺少重要参数';
            $this->ajaxReturn($return);
        }
        if(!preg_match("/^1[3|4|5|7|8][0-9]\d{8}$/",$_POST['tel'])){
            $return['stu'] = '0';
            $return['code'] = '109';
            $return['msg'] = '请输入正确的手机号码！';
            $this->ajaxReturn($return);
        }
        $id = trim(I("post.id"));
        $uid =I("post.uid");
        $addr = M("address");
        $addr->create();
        $addr->uid=$uid;
        $result = $addr->where("id = ".$id." and uid = ".$uid)->save();
        if($result){
            $return['stu'] = '1';
            $return['res'] = $result;
            $this->ajaxReturn($return);
        }else{
            $return['stu'] = '0';
            $return['code'] = '110';
            $return['msg'] = '地址修改失败';
            $this->ajaxReturn($return);
        }
    }

    //地址删除
    public function dodel(){
        $uid=I('post.uid');
        $id = I("post.id");
        if(empty($uid)||empty($id)){
            $return['stu'] = '0';
            $return['code'] = '108';
            $return['msg'] = '缺少重要参数';
            $this->ajaxReturn($return);
        }else{
            $where['uid']=$uid;
            $where['id']=$id;
        }
        $address = M("address")->where("id = ".$id." and uid = ".$uid)->find();
        if($address){
            $result = M("address")->where("id = ".$id)->delete();
            if($result){
                $return['stu'] = '1';
                $return['res'] = $result;
                $this->ajaxReturn($return);
            }else{
                $return['stu'] = '0';
                $return['code'] = '110';
                $return['msg'] = '删除失败';
                $this->ajaxReturn($return);
            }
        }else{
            $return['stu'] = '0';
            $return['code'] = '109';
            $return['msg'] = '删除的数据不存在';
            $this->ajaxReturn($return);
        }
    }

}