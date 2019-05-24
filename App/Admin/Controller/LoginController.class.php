<?php
namespace Admin\Controller;

use Think\Controller;

class LoginController extends Controller
{
    public function login()
    {
        if (!IS_POST) {
            $this->display();
        } else {
            $username = I('post.username');
            $password =I('post.password');
            $verify = I('post.verify');
            
            if (!check_verify($verify)) {
                $this->error('验证码错误！', U('Login/login'));
            }
            $admin = M("Admin")->where("username = '".$username."'")->find();
            
            if ($admin) {
                $password = md5(md5($password).$admin['rand'].md5($admin['mobile']));
                $result = M('Admin')->where("username='".$username."' and password='".$password."'")->find(); //查询判断账号和密码是否正确

                if ($result) {
                    if ($result['is_seal'] == 1) {
                        $this->error('对不起，你的账号已封号');
                    }
                    $_SESSION['adminid'] = $result['id'];  //保存用户ID到SESSION
                    $_SESSION['adminuser'] = $result['username'];  //保存用户名到SESSION
                    $_SESSION['adminqid'] = $result['qid'];  //保存权限到SESSION
                    $_SESSION['name'] = $result['name'];  //保存权限到SESSION
                    //$re = M('Admin')->where("id = ".$result['id'])->setInc('cishu');  //登陆次数加1
                    $this->success('登陆成功，正在跳转....', U('Index/index'));
                } else {
                    $this->error('账号或者密码错误，请重新登陆', U('Login/login'));
                }
            } else {
                $this->error('该帐号不存在', U('Login/login'));
            }
        }
    }
    
    //登陆注销
    public function logout()
    {
        session(null); //清空全部session
        $url = U('login/login');
        echo "<script>top.location.href='".$url."';</script>";
    }
    
    //验证码
    public function verify()
    {
        // $config = array(
        // 'fontSize'    =>    22,    // 验证码字体大小
        // 'length'      =>    3,     // 验证码位数
        // 'imageW'      =>    125,
        // 'imageH'      =>    36,
        // 'useNoise'    =>    false, // 关闭验证码杂点
        // );
        $Verify = new \Think\Verify();
        $Verify->fontSize = 18;
        $Verify->length   = 4;
        $Verify->useNoise = false;
        $Verify->useCurve = false;
        $Verify->codeSet = '0123456789';
        $Verify->imageW = 120;
        $Verify->imageH = 50;
        $Verify->expire = 60;
        $Verify->entry();

        // ob_clean();
        // $Verify = new \Think\Verify($config);
        // $Verify->codeSet = '0123456789';
        // $Verify->entry();
    }
}
