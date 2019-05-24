<?php
// 本类由系统自动生成，仅供测试用途
namespace 	Home\Controller;
use Think\CommController\Controller;
class UserinfoController extends UserbaseController {
    //修改信息
    public function index(){
        $top="我的资料";
        $ziliao=M('user')->where('id='.$_SESSION['uid'])->find();
        $this->assign('ziliao',$ziliao);
        $this->assign('top',$top);
        $this->display();
    }
    //修改资料实现
    public function doinfo(){
        $user['uname'] = trim(I("post.uname"));
        $user['sex'] = trim(I("post.sex"));
        $user['srtime'] =strtotime(I("post.srtime"));
        $user['card'] =strtotime(I("post.card"));
        if(empty($user['uname'])){
            $data['status'] = 0;
            $data['msg'] = "请输入你的昵称！";
            $this->ajaxReturn($data);
        }
        if(empty($user['srtime'])){
            $data['status'] = 0;
            $data['msg'] = "请输入生日！";
            $this->ajaxReturn($data);
        }
        if(empty($user['card'])){
            $data['status'] = 0;
            $data['msg'] = "请输入身份证号";
            $this->ajaxReturn($data);
        }
        if(!preg_match("/^\d{15}|\d{18}$/",$user['card'])){
            $data['status'] = 0;
            $data['msg'] = "请输入正确的身份证！";
            $this->ajaxReturn($data);
        }
        if($_FILES['image']['name']){
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize  = 1024000 ;// 设置附件上传大小
            $upload->exts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->savePath =  '/news/';// 设置附件上传目录
            $upload->autoCheck =  false;
            $info =  $upload->upload();
            if(!$info){
                        // 上传错误提示错误信息
                        $this->error($upload->getError());
            }
            $user['pic']= '/Public/uploads'.$info['image']['savepath'].$info['image']['savename'];
            // $image = new \Think\Image();
            // $image->open(".".$tu);
            // $image->thumb(518, 262,\Think\Image::IMAGE_THUMB_FIXED)->save(".".$tu);
            // $news->imgurl=$tu;
        }
        $result = M("user")->where("id = ".(int)$_SESSION['uid'])->save($user);
        if($result !== false){
            $this->success('资料修改成功',U("userinfo/index"));
        }else{
        	$this->error('资料修改失败，请稍候操作');
        }
    }
    //签到
   public function sign(){
      $uid=$_SESSION['uid'];
      if(!$uid){
        $data['status'] = 0;
        $data['msg'] = "参数缺失！";
        $this->ajaxReturn($data);
      }
      $time=time();
      $mSign=M('sign');
      $mSignDetail=M('sign_detail');
      $signInfo=$mSign->where('uid='.$uid)->find();
      $user=M('user')->where('id='.$uid)->find();
      if($signInfo){
          $sign_id = $signInfo['id'];
          $last_time =date('Y-m-d',$signInfo['last_time']);
          $sign_count = $signInfo['sign_count'];
          $yesterday = date("Y-m-d",strtotime("-1 day"));
          $today=date('Y-m-d');
          if($last_time==$today){
                $data['status'] = 0;
                $data['msg'] = "您今天已经签到过了！";
                $this->ajaxReturn($data);
          }elseif($last_time==$yesterday){
            $sign_count += 1;
          }else{
             $sign_count = 0;
          }
          if($sign_count==7){
              $result3=M('user')->where('id='.$uid)->setInc('integral',5);
              $result4=$mSign->where($where)->setField('sign_count','0');
              //添加积分明细
             $jifen['uid']=$uid;
             $jifen['xiangmu']='连续签到成功，增加积分5';
             $jifen['addtime']=time();
             $jfresult=M('pointmx')->add($jifen);
           }else{
             $where['uid']=$uid;
             $edata['sign_count']=$sign_count;
             $edata['last_time']=$time;
             $result=$mSign->where($where)->save($edata);
             $result2=M('user')->where('id='.$uid)->setInc('integral',1);
             //添加积分明细
             $jifen['uid']=$uid;
             $jifen['xiangmu']='签到成功，增加积分1';
             $jifen['addtime']=time();
             $jfresult=M('pointmx')->add($jifen);
           } 
       }else{
           $data2['uid']=$uid;
           $data2['username']=$user['uname'];
           $data2['sign_count']=1;
           $data2['last_time']=$time;
           $data2['create_time']=$time;
           $sign_id=$mSign->add($data2);
           $result=$sign_id;
           $result2=M('user')->where('id='.$uid)->setInc('integral',1);
       }
       if($result){
            $detailData['sign_id']=$sign_id;
            $detailData['sign_time']=$time;
            $detailRet=$mSignDetail->add($detailData);
            if($detailRet){
              //添加积分明细
               $jifen['uid']=$uid;
               $jifen['xiangmu']='签到成功，增加积分1';
               $jifen['addtime']=time();
               $jfresult=M('pointmx')->add($jifen);
                $data['status'] = 1;
                $data['msg'] = "签到成功！";
                $this->ajaxReturn($data);
            }else{
               $data['status'] = 0;
                $data['msg'] = "签到失败！";
                $this->ajaxReturn($data);
            }
       }else{
            $data['status'] = 0;
            $data['msg'] = "操作主表异常！";
            $this->ajaxReturn($data);
       }
   }
}