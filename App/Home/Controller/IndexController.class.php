<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\BaseController\Controller;
class IndexController extends BaseController {
    //商城首页
    public function index(){
        //大型家具
        $jiaju1=M('goods')->where('scate=63 and is_del=-1 and is_up=1')->order('sort desc,addtime desc')->limit(2)->select();
        $jiaju=M('goods')->where('scate=63 and is_del=-1 and is_up=1')->order('sort desc,addtime desc')->limit(2,21)->select();
        $this->assign('jiaju1',$jiaju1);
        $this->assign('jiaju',$jiaju);
        //办公日常用品
        $bangong1=M('goods')->where('scate=62 and is_del=-1 and is_up=1')->order('sort desc,addtime desc')->limit(2)->select();
        $bangong=M('goods')->where('scate=62 and is_del=-1 and is_up=1')->order('sort desc,addtime desc')->limit(2,21)->select();
        $this->assign('bangong1',$bangong1);
        $this->assign('bangong',$bangong);
        //绿植保洁
        $lvzhi1=M('goods')->where('scate=66 and is_del=-1 and is_up=1')->order('sort desc,addtime desc')->limit(2)->select();
        $lvzhi=M('goods')->where('scate=66 and is_del=-1 and is_up=1')->order('sort desc,addtime desc')->limit(2,21)->select();
        $this->assign('lvzhi1',$lvzhi1);
        $this->assign('lvzhi',$lvzhi);
        //品牌策划
        $brand=M('brand')->order('sort desc,addtime desc')->limit(2)->select();
        $brand=M('brand')->order('sort desc,addtime desc')->limit(2,21)->select();
        $this->assign('brand1',$brand1);
        $this->assign('brand',$brand);
        //企业礼品
        $qiye1=M('goods')->where('scate=60 and is_del=-1 and is_up=1')->order('sort desc,addtime desc')->limit(2)->select();
        $qiye=M('goods')->where('scate=60 and is_del=-1 and is_up=1')->order('sort desc,addtime desc')->limit(2,21)->select();
        $this->assign('qiye1',$qiye1);
        $this->assign('qiye',$qiye);
        //员工福利
        $fuli1=M('goods')->where('scate=61 and is_del=-1 and is_up=1')->order('sort desc,addtime desc')->limit(2)->select();
        $fuli=M('goods')->where('scate=61 and is_del=-1 and is_up=1')->order('sort desc,addtime desc')->limit(2,21)->select();
        $this->assign('fuli1',$fuli1);
        $this->assign('fuli',$fuli);
        //商城入口
        $shang1=M('goods')->where('scate=68 and is_del=-1 and is_up=1')->order('sort desc,addtime desc')->limit(2)->select();
        $shang=M('goods')->where('scate=68 and is_del=-1 and is_up=1')->order('sort desc,addtime desc')->limit(2,21)->select();
        $this->assign('shang1',$shang1);
        $this->assign('shang',$shang);
        //获取轮播图
        $advert = M("ad")->order("savetime desc")->select();//轮播
        $this->assign('advert',$advert);
        $this->assign('top','首页');
        $this->display();
    }

}