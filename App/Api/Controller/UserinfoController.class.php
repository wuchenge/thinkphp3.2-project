<?php
// 本类由系统自动生成，仅供测试用途
namespace Api\Controller;
use Think\Controller;
class UserinfoController extends Controller {
    //返回当前用户资料
    public function nowuser(){
      $uid=I("post.uid");
      $res=M('user')->where('id='.$uid)->find();
      $res['pic']="https://".$_SERVER['SERVER_NAME'].$res['pic'];
      $return['stu'] = '1';
      $return['result'] = $res;
      $this->ajaxReturn($return);
    }
    //修改资料实现
    public function doinfo(){
        $uid=I("post.uid");
        $user['uname'] = trim(I("post.uname"));
        $user['sex'] = trim(I("post.sex"));
        $user['srtime'] =I("post.srtime");
        $user['pic']=I("post.pic");
        // if(empty($user['uname'])||empty($user['sex'])||empty($user['srtime'])||empty($user['pic'])){
        //     $return['stu'] = '0';
        //     $return['code'] = '108';
        //     $return['msg'] = '缺少必要的参数';
        //     $this->ajaxReturn($return);
        // }
        if($_FILES['file']){
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize  = 1024000 ;// 设置附件上传大小
            $upload->exts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->savePath =  '/weixin/';// 设置附件上传目录
            $upload->autoCheck =  false;
            $info =  $upload->upload();
            if(!$info){
                // 上传错误提示错误信息
                 $this->error($upload->getError());
            }
             $user['pic']='/Public/uploads'.$info['file']['savepath'].$info['file']['savename'];
        }
        // $res = $_FILES['file'];
        // $res2 = $this->uploadimg($res);
        // $user['pic']=$res2;
        $result = M("user")->where("id = ".$uid)->save($user);
        $result2 = M("user")->where("id = ".$uid)->find();
        $result2['pic']="https://".$_SERVER['SERVER_NAME'].$result2['pic'];
        if($result !== false){
            $return['stu'] = '1';
            $return['msg'] = '修改资料成功';
            $return['result'] = $result2;
            $this->ajaxReturn($return);
        }else{
            $return['stu'] = '0';
            $return['code'] = '109';
            $return['msg'] = '修改资料失败';
            $this->ajaxReturn($return);
        }
    }
    public function uploadimg($file){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     '/Public/uploads'; // 设置附件上传根目录
        $upload->savePath  =     '/weixin'; // 设置附件上传（子）目录
        // 上传文件
        $info   =   $upload->uploadOne($file);
        if(!$info) {// 上传错误提示错误信息
           return $upload->getError();
        }else{// 上传成功
            return $info['savepath'].$info['savename'];
        }
    }
    //  public function uploadimg(){
    //     $file = request()->file('file');
    //     if ($file) {
    //         $info = $file->move('public/upload/weixin/');
    //         if ($info) {
    //             $file = $info->getSaveName();
    //             $res = array('errCode'=>0,'errMsg'=>'图片上传成功','file'=>$file);
    //             return json($res);
    //         }
    //     }
       
    // }
    //签到
   public function sign(){
      $uid=trim(I("post.uid/d"));
      if(!$uid){
            $return['stu'] = '0';
            $return['code'] = '108';
            $return['msg'] = '参数缺失！';
            $this->ajaxReturn($return);
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
                $return['stu'] = '0';
                $return['code'] = '109';
                $return['sign_count'] = $signInfo['sign_count'];
                $return['msg'] = '您今天已经签到过了！';
                $this->ajaxReturn($return);
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
               
                $return['stu'] = '1';
                $return['res'] = $jfresult;
                $return['sign_count'] = $signInfo['sign_count'];
                $this->ajaxReturn($return);
            }else{
                $return['stu'] = '0';
                $return['code'] = '110';
                $return['msg'] = '签到失败！';
                $return['sign_count'] = $signInfo['sign_count'];
                $this->ajaxReturn($return);
            }
       }else{
            $return['stu'] = '0';
            $return['code'] = '111';
            $return['msg'] = '操作主表异常！';
            $return['sign_count'] = $signInfo['sign_count'];
            $this->ajaxReturn($return);
       }
   }

}