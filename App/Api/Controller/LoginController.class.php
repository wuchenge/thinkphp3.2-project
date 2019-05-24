<?php
namespace Api\Controller;
use Think\Controller;
class LoginController extends Controller{
         //绑定账号
    public function dobind(){
        $user['tel'] = trim(I("post.tel"));
        $phone_code = trim(I('post.phonecode'));
        $openid=I('post.openid');
        $user['uname']=trim(I("post.uname"));
        $user['pic']=trim(I("post.pic"));
        $user['sex']=trim(I("post.sex"));
        if(empty($user['tel'])){
            $return['stu'] = '0';
            $return['code'] = '108';
            $return['msg'] = '缺少重要参数';
            $this->ajaxReturn($return);
        }
        if(!preg_match("/^1[3|4|5|7|8|9][0-9]\d{7,11}$/",$user['tel'])){
            $return['stu'] = '0';
            $return['code'] = '109';
            $return['msg'] = '请输入正确的手机号码！';
            $this->ajaxReturn($return);
        }
        $when='';
        $when['tel']=$user['tel'];
        $when['code']=$phone_code;
        $when['type']=1;
        $result = M('code')->where($when)->order('addtime desc')->limit(1)->find();
        if($result){
            $r = M("User")->where("tel = '".$user['tel']."'")->find();
            if($r){
                $return['stu'] = '0';
                $return['code'] = '111';
                $return['msg'] = '该手机号已经被绑定';
                $this->ajaxReturn($return);
            }else{
                $user['lastlogin']=time();
                $r2 = M("User")->where("openid = '".$openid."'")->find();
                if($r2){
                     $result1=M('user')->where("openid = '".$openid."'")->save($user);
                     $nowuser=M('user')->where("openid = '".$openid."'")->find();
                }else{
                    $user['openid']=$openid;
                    $result1=M('user')->add($user);
                    $nowuser=M('user')->where('id='.$result1)->find();
                }
            }
            $return['stu'] = '1';
            $return['user']=$nowuser;
            $return['msg'] = '恭喜你，绑定账号成功！';
            $this->ajaxReturn($return);

        }else{
            $return['stu'] = '0';
            $return['code'] = '113';
            $return['msg'] = '对不起，你输入的验证码有误，请重新输入';
            $this->ajaxReturn($return);
         }
        
    }
    //获取openid，添加账号
    public function doregist(){
        $code = trim(I("post.code"));
        $result1 = openid($code);
        $openid=$result1['openid'];
        $r = M("User")->where("openid = '".$openid."'")->find();
        $domain=strpos($r['pic'],'http');
        if($domain === false){
             $r['pic']="https://".$_SERVER['SERVER_NAME'].$r['pic'];
          
        }else{
             $r['pic']=$r['pic'];
        }
        if($r){
            if($r['tel']){
                $return['stu'] = '1';
                $return['msg'] = '该账号已添加过';
                $return['openid'] = $openid;
                $return['huifu'] = 1;
                $return['user'] =$r;
                $this->ajaxReturn($return);
            }else{
                $return['stu'] = '1';
                $return['msg'] = '恭喜你，微信认证成功！';
                $return['openid'] = $openid;
                $return['huifu'] = 2;
                $this->ajaxReturn($return);
            }
        }else{
            $return['stu'] = '1';
            $return['msg'] = '恭喜你，微信认证成功！';
            $return['openid'] = $openid;
            $return['huifu'] = 2;
            $this->ajaxReturn($return);
        }
    }

    //快捷登陆
    public function login(){
        $tel = trim(I('post.tel'));
        $phone_code = trim(I('post.phonecode'));
        if(empty($tel)){
            $return['stu'] = '0';
            $return['code'] = '108';
            $return['msg'] = '缺少重要参数';
            $this->ajaxReturn($return);
        }
        if(!preg_match("/^1[3|4|5|7|8|9][0-9]\d{7,11}$/",$tel)){
            $return['stu'] = '0';
            $return['code'] = '109';
            $return['msg'] = '请输入正确的手机号码！';
            $this->ajaxReturn($return);
        }
        $r = M("User")->where("tel = '".$tel."'")->find();
        if($r){
            $when='';
            $when['tel']=$tel;
            $when['code']=$phone_code;
            $when['type']=2;
            $result = M('code')->where($when)->find();
            if($result){
                if($r['status'] !=1){
                    $return['stu'] = '0';
                    $return['code'] = '110';
                    $return['msg'] = '对不起，你的账号状态异常，请联系管理员解除异常';
                    $this->ajaxReturn($return);
                }

                $data['status'] = 1;
                $data['msg'] = "恭喜你，登陆成功！";
                $deladdr=M('user')->where("tel = '".$tel."'")->setField('lastlogin',time());
                $this->ajaxReturn($data);
            }else{
                $return['stu'] = '0';
                $return['code'] = '111';
                $return['msg'] = '对不起，你输入的验证码有误，请重新输入';
                $this->ajaxReturn($return);
            }
        }else{
            $return['stu'] = '0';
            $return['code'] = '112';
            $return['msg'] = '你输入的手机号不存在';
            $this->ajaxReturn($return);
        }
    }
     //密码登陆
    public function dologin2(){
        $tel = trim(I('post.tel'));
        $password = trim(I('post.password'));
        if(empty($tel)||empty($password)){
            $return['stu'] = '0';
            $return['code'] = '108';
            $return['msg'] = '缺少重要参数';
            $this->ajaxReturn($return);
        }
        $r = M("User")->where("tel = '".$tel."'")->find();
        if($r){
            $when='';
            $when['tel']=$tel;
            $when['password']=md5(md5($password).$r['rand'].md5($tel));
            $result = M('User')->where($when)->find();
            if($result){
                if($result['status'] !=1){
                    $return['stu'] = '0';
                    $return['code'] = '109';
                    $return['msg'] = '对不起，你的账号状态异常，请联系管理员解除异常';
                    $this->ajaxReturn($return);
                }
                $deladdr=M('user')->where($when)->setField('lastlogin',time());

                $return['stu'] = '1';
                $return['msg'] = '你输入的手机号不存在';
                $this->ajaxReturn($return);
                
            }else{
                $return['stu'] = '0';
                $return['code'] = '110';
                $return['msg'] = '对不起，你输入的密码有误，请重新输入';
                $this->ajaxReturn($return);
            }
        }else{
            $return['stu'] = '0';
            $return['code'] = '111';
            $return['msg'] = '你输入的手机号不存在';
            $this->ajaxReturn($return);
        }
    }
    


    
    //登陆注销
    public function out(){
        session(null); //清空全部session
        $url = "http://".$_SERVER['HTTP_HOST'];
        header("Location:$url");
    }
    
    //快捷登录验证码
    public function kjcodesend(){
        $tel = trim(I("post.tel"));
        if(empty($tel)){
            $return['stu'] = '0';
            $return['code'] = '108';
            $return['msg'] = '缺少重要参数';
            $this->ajaxReturn($return);
        }
        // if(!preg_match("/^1[3|4|5|6|7|8|9][0-9]\d{7,11}$/",$tel)){
        //     $return['stu'] = '0';
        //     $return['code'] = '109';
        //     $return['msg'] = '请输入正确的手机号码！';
        //     $this->ajaxReturn($return);
        // }
        $code2 = M("Code")->where("type = 1 and tel = '".$tel."'")->order('addtime desc')->find();
        if($code2){
            $s = $code2['addtime']+60;
            if(time() < $s){
                $return['stu'] = '0';
                $return['code'] = '111';
                $return['msg'] = '60秒内只能发送一次';
                $this->ajaxReturn($return);
            }
        }
        $code = rand(100000,999999);
        $c['tel'] = $tel;
        $c['code'] = $code;
        $c['addtime'] = time();
        $c['type'] = 1;
        $result = M("Code")->add($c);
        if($result){
            //$send = new \Think\SendSms();  //实例化短信接口
            $content = '尊敬的用户，你好！验证码为'.$code.'，十分钟有效时间，请尽快操作！';
            //$result2 = $send->send($tel,$content);
            $result2=sendmail($tel,$content);
            if($result2['status'] == 1){
                $return['stu'] = '1';
                $return['msg'] = '发送成功！';
                $this->ajaxReturn($return);
            }else{
                M("Code")->where['id = '.$result]->delete();
                $return['stu'] = '0';
                $return['code'] = '112';
                $return['msg'] = $result2['mes'];
                $this->ajaxReturn($return);
            }
        }else{
            $return['stu'] = '0';
            $return['code'] = '113';
            $return['msg'] = "发送失败，请稍候操作";
            $this->ajaxReturn($return);
        }
    }
}