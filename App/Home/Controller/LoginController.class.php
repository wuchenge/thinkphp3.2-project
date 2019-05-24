<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends BaseController{
    public function login(){
        if(!empty($_SESSION['uid'])){
            $this->redirect("order/index");
        }
        $this->display();
    }
    //快捷登陆
    public function dologin(){
        $tel = trim(I('post.tel2'));
        $phone_code = trim(I('post.phone_code'));
        if(empty($tel)){
            $data['status'] = 0;
            $data['msg'] = "手机号码不能为空！";
            $this->ajaxReturn($data);
        }
        if(!preg_match("/^1[3|4|5|7|8][0-9]\d{7,11}$/",$tel)){
            $data['status'] = 0;
            $data['msg'] = "请输入正确的手机号码！";
            $this->ajaxReturn($data);
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
                    $data['status'] = 0;
                    $data['msg'] = "对不起，你的账号状态异常，请联系管理员解除异常";
                    $this->ajaxReturn($data);
                }
                $_SESSION['uid'] = $r['id'];  //保存用户ID到SESSION
                $_SESSION['username'] = $r['uname'];
                $_SESSION['tel'] = $r['tel'];

                $data['status'] = 1;
                $data['msg'] = "恭喜你，登陆成功！";
                $deladdr=M('user')->where('id ='.$_SESSION['uid'])->setField('lastlogin',time());
                $this->ajaxReturn($data);
            }else{
                $data['status'] = 0;
                $data['msg'] = "对不起，你输入的验证码有误，请重新输入";
                $this->ajaxReturn($data);
            }
        }else{
            $data['status'] = 0;
            $data['msg'] = "你输入的手机号不存在";
            $this->ajaxReturn($data);
        }
    }
    //密码登陆
    public function dologin2(){
        $tel = trim(I('post.tel'));
        $password = trim(I('post.password'));
        if(empty($tel)){
            $data['status'] = 0;
            $data['msg'] = "手机号码不能为空！";
            $this->ajaxReturn($data);
        }
        $r = M("User")->where("tel = '".$tel."'")->find();
        if($r){
            $when='';
            $when['tel']=$tel;
            $when['password']=md5(md5($password).$r['rand'].md5($tel));
            $result = M('User')->where($when)->find();
            if($result){
                if($result['status'] !=1){
                    $data['status'] = 0;
                    $data['msg'] = "对不起，你的账号状态异常，请联系管理员解除异常";
                    $this->ajaxReturn($data);
                }
                $_SESSION['uid'] = $result['id'];  //保存用户ID到SESSION
                $_SESSION['username'] = $result['uname'];
                $_SESSION['tel'] = $result['tel'];
                $data['status'] = 1;
                $data['msg'] = "恭喜你，登陆成功！";
                $deladdr=M('user')->where('id ='.$_SESSION['uid'])->setField('lastlogin',time());
                $this->ajaxReturn($data);
            }else{
                $data['status'] = 0;
                $data['msg'] = "对不起，你输入的密码有误，请重新输入";
                $this->ajaxReturn($data);
            }
        }else{
            $data['status'] = 0;
            $data['msg'] = "你输入的手机号不存在";
            $this->ajaxReturn($data);
        }
    }
    
    //注册
    public function register(){
        if(!empty($_SESSION['uid'])){
            $this->redirect("order/index");
        }
        $this->display();

    }
    
    public function doregist(){
        $user['tel'] = trim(I("post.tel"));
        $user['rand'] = rand(10000,99999);
        $phone_code = trim(I("post.phone_code"));
        $password = trim(I("post.password"));
        $cfmpwd = trim(I("post.cfmpwd"));
        if(!preg_match("/^1[3|4|5|7|8][0-9]\d{7,11}$/",$user['tel'])){
            $data['status'] = 0;
            $data['msg'] = "请输入正确的手机号码！";
            $this->ajaxReturn($data);
        }
        $r = M("User")->where("tel = '".$user['tel']."'")->find();
        if($r){
            $data['status'] = 0;
            $data['msg'] = "你输入的手机号已存在";
            $this->ajaxReturn($data);
        }
        $code2 = M("Code")->where("type = 1 and tel = '".$user['tel']."'")->order('addtime desc')->find();
        if($code2){
            $s = $code2['addtime']+600;
            if(time() > $s){
                $data['status'] = 0;
                $data['msg'] = "手机验证码已失效";
                $this->ajaxReturn($data);
            }else{
                if($phone_code != $code2['code']){
                    $data['status'] = 0;
                    $data['msg'] = "手机验证码输入有误";
                    $this->ajaxReturn($data);
                }
            }
        }else{
            $data['status'] = 0;
            $data['msg'] = "该手机号与验证手机号不匹配";
            $this->ajaxReturn($data);
        }
        if(strlen($password) < 6 || strlen($password) > 20){
            $data['status'] = 0;
            $data['msg'] = "密码长度在6-20个字符之间";
            $this->ajaxReturn($data);
        }
        if($password != $cfmpwd){
            $data['status'] = 0;
            $data['msg'] = "两次输入密码不一致";
            $this->ajaxReturn($data);
        }
        $user['password']= md5(md5($password).$user['rand'].md5($user['tel']));
        $user['addtime'] = time();
        $result1 = M("User")->add($user);
        // $result=M("coupon")->where("cid= 1")->find();
        // if($result['is_open'] == 1){
        //         $ma['uid']=$result1;
        //         $ma['uname']=$user['tel'];
        //         $ma['cid']=$result['cid'];
        //         $ma['addtime']=time();
        //         $ma['end']=$result['end'];
        //         $ma['conditionm']=$result['condition'];
        //         $ma['money']=$result['money'];
        //         $ma['start']=$result['start'];
        //         M('usercoupon')->add($ma);
        // }
        if($result1){
             $qwer['type']=-1;
             $result = M("Code")->where(' tel = '.$user['tel'])->order('id desc')->save($qwer);
        $_SESSION['uid'] = $result1;
        $_SESSION['tel'] = $user['tel'];
            $data['status'] = 1;
            $data['msg'] = "恭喜你，注册成功！";
            $this->ajaxReturn($data);
        }else{
            $data['status'] = 0;
            $data['msg'] = "对不起，注册失败，请稍候操作";
            $this->ajaxReturn($data);
        }
        
    }
    
    //找回密码
    public function forget(){
        if(!empty($_SESSION['uid'])){
            $this->redirect("order/index");
        }
        $this->display();
    }
    
    public function password(){
        $tel = trim(I("post.tel"));
        $phone_code = trim(I("post.phone_code"));
        $password = trim(I("post.password"));
        $cfmpwd = trim(I("post.cfmpwd"));
        $u = M("user")->where("tel = '".$tel."'")->find();
        if(empty($u)){
            $data['status'] = 0;
            $data['msg'] = "你输入的电话号码不存在";
            $this->ajaxReturn($data);
        }
        $code2 = M("Code")->where("type = 3 and  tel = '".$u['tel']."'")->order('addtime desc')->find();
        if($code2){
            $s = $code2['addtime']+600;
            if(time() > $s){
                $data['status'] = 0;
                $data['msg'] = "手机验证码已失效";
                $this->ajaxReturn($data);
            }else{
                if($phone_code != $code2['code']){
                    $data['status'] = 0;
                    $data['msg'] = "手机验证码输入有误";
                    $this->ajaxReturn($data);
                }
            }
        }else{
            $data['status'] = 0;
            $data['msg'] = "该手机号与验证手机号不匹配";
            $this->ajaxReturn($data);
        }
        if(strlen($password) < 6 || strlen($password) > 20){
            $data['status'] = 0;
            $data['msg'] = "密码长度在6-20个字符之间";
            $this->ajaxReturn($data);
        }
        if($password != $cfmpwd){
            $data['status'] = 0;
            $data['msg'] = "两次输入密码不一致";
            $this->ajaxReturn($data);
        }
        $user['rand'] = rand(10000,99999);
        //$user['password']= md5(md5($password).$user['rand'].md5($tel));
        $user['password']= md5(md5($password).$user['rand'].md5($u['tel']));
        $result = M("User")->where("id = ".$u['id'])->save($user);
        if($result !== false){
             $qwer['type']=-1;
             $result = M("Code")->where(' tel = '.$u['tel'])->order('id desc')->save($qwer);
            $data['status'] = 1;
            $data['msg'] = "恭喜你，密码找回成功！";
            $this->ajaxReturn($data);
        }else{
            $data['status'] = 0;
            $data['msg'] = "对不起，找回失败，请稍候操作";
            $this->ajaxReturn($data);
        }
        
    }
    
    
    //登陆注销
    public function out(){
        session(null); //清空全部session
        $url = "http://".$_SERVER['HTTP_HOST'];
        header("Location:$url");
    }
    
    //免费获取验证码
    public function codesend(){
        $tel = trim(I("post.tel"));
        if(!preg_match("/^1[3|4|5|7|8|9][0-9]\d{7,11}$/",$tel)){
            $data['status'] = 0;
            $data['msg'] = "请输入正确的手机号码！";
            $this->ajaxReturn($data);
        }
        $user = M("User")->where("tel = '".$tel."'")->find();
        if($user){
            $data['status'] = 0;
            $data['msg'] = "该手机号已经注册";
            $this->ajaxReturn($data);
        }
        $code2 = M("Code")->where("type = 1 and tel = '".$tel."'")->order('addtime desc')->find();
        if($code2){
            $s = $code2['addtime']+60;
            if(time() < $s){
                $data['status'] = 0;
                $data['msg'] = "60秒内只能发送一次";
                $this->ajaxReturn($data);
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
            $content = '尊敬的用户，你好！你的注册验证码为'.$code.'，十分钟有效时间，请尽快完成注册！';
            //$result2 = $send->send($tel,$content);
            $result2=sendmail($tel,$content);
            //dump($result2['status']);die;
            if($result2['status'] == 1){
                $data['status'] = 1;
                $data['msg'] = "发送成功！";
                $this->ajaxReturn($data);
            }else{
                M("Code")->where("id = ".$result)->delete();
                $data['status'] = 0;
                $data['msg'] = $result2['mes'];
                $this->ajaxReturn($data);
            }
        }else{
            $data['status'] = 0;
            $data['msg'] = "发送失败，请稍候操作";
            $this->ajaxReturn($data);
        }
    }

    public function pwdcodesend(){
        $tel = trim(I("post.tel"));
        if(!preg_match("/^1[3|4|5|7|8][0-9]\d{7,11}$/",$tel)){
            $data['status'] = 0;
            $data['msg'] = "请输入正确的手机号码！";
            $this->ajaxReturn($data);
        }
        $user = M("User")->where("tel = '".$tel."'")->find();
        if(!$user){
            $data['status'] = 0;
            $data['msg'] = "该手机号还没有注册";
            $this->ajaxReturn($data);
        }
        $code2 = M("Code")->where("type = 3 and tel = '".$tel."'")->order('addtime desc')->find();
        if($code2){
            $s = $code2['addtime']+60;
            if(time() < $s){
                $data['status'] = 0;
                $data['msg'] = "60秒内只能发送一次";
                $this->ajaxReturn($data);
            }
        }
        $code = rand(100000,999999);
        $c['tel'] = $tel;
        $c['code'] = $code;
        $c['addtime'] = time();
        $c['type'] = 3;
        $result = M("Code")->add($c);
        if($result){
            //$send = new \Think\SendSms();  //实例化短信接口
            $content = '尊敬的用户，你好！你正在找回密码，验证码为'.$code.'，十分钟有效时间，请尽快操作！';
            //$result2 = $send->send($tel,$content);
            $result2=sendmail($tel,$content);
            if($result2['status'] == 1){
                $data['status'] = 1;
                $data['msg'] = "发送成功！";
                $this->ajaxReturn($data);
            }else{
                M("Code")->where['id = '.$result]->delete();
                $data['status'] = 0;
                $data['msg'] = $result2['mes'];
                $this->ajaxReturn($data);
            }
        }else{
            $data['status'] = 0;
            $data['msg'] = "发送失败，请稍候操作";
            $this->ajaxReturn($data);
        }
    }

    //快捷登录
     public function kjcodesend(){
        $tel = trim(I("post.tel"));
        if(!preg_match("/^1[3|4|5|7|8][0-9]\d{7,11}$/",$tel)){
            $data['status'] = 0;
            $data['msg'] = "请输入正确的手机号码！";
            $this->ajaxReturn($data);
        }
        $user = M("User")->where("tel = '".$tel."'")->find();
        if(!$user){
            $data['status'] = 0;
            $data['msg'] = "该手机号还没有注册";
            $this->ajaxReturn($data);
        }
        $code2 = M("Code")->where("type = 2 and tel = '".$tel."'")->order('addtime desc')->find();
        if($code2){
            $s = $code2['addtime']+60;
            if(time() < $s){
                $data['status'] = 0;
                $data['msg'] = "60秒内只能发送一次";
                $this->ajaxReturn($data);
            }
        }
        $code = rand(100000,999999);
        $c['tel'] = $tel;
        $c['code'] = $code;
        $c['addtime'] = time();
        $c['type'] = 2;
        $result = M("Code")->add($c);
        if($result){
            //$send = new \Think\SendSms();  //实例化短信接口
            $content = '尊敬的用户，你好！你正在快捷登录，验证码为'.$code.'，十分钟有效时间，请尽快操作！';
            //$result2 = $send->send($tel,$content);
            $result2=sendmail($tel,$content);
            if($result2['status'] == 1){
                $data['status'] = 1;
                $data['msg'] = "发送成功！";
                $this->ajaxReturn($data);
            }else{
                M("Code")->where['id = '.$result]->delete();
                $data['status'] = 0;
                $data['msg'] = $result2['mes'];
                $this->ajaxReturn($data);
            }
        }else{
            $data['status'] = 0;
            $data['msg'] = "发送失败，请稍候操作";
            $this->ajaxReturn($data);
        }
    }
}