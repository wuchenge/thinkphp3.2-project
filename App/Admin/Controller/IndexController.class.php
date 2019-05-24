<?php
namespace Admin\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function _initialize()
    {
        if (empty($_SESSION['adminid']) or !isset($_SESSION['adminid'])) {
            $url = U('login/login');
            echo "<script>top.location.href='".$url."';</script>";
        }
        $gla=M('admin')->find($_SESSION['adminid']);
        $glb=M('role')->find($gla['qid']);
        $this->assign('glb', $glb);
    }
    public function index()
    {
        $this->display();
    }
}
