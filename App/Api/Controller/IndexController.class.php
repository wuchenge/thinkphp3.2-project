<?php
// 本类由系统自动生成，仅供测试用途
namespace Api\Controller;
use Think\Controller;
class IndexController extends Controller {
    //商城首页
    public function index(){
        //大型家具
        $res['jiaju1']=M('goods')->where('scate=62 and is_del=-1 and is_up=1')->limit(2)->select();
        $res['jiaju']=M('goods')->where('scate=62 and is_del=-1 and is_up=1')->limit(2,15)->select();
        //办公日常用品
        $res['bangong1']=M('goods')->where('scate=63 and is_del=-1 and is_up=1')->limit(2)->select();
        $res['bangong']=M('goods')->where('scate=63 and is_del=-1 and is_up=1')->select();
        //绿植保洁
        $res['lvzhi1']=M('goods')->where('scate=66 and is_del=-1 and is_up=1')->limit(2)->select();
        $res['lvzhi']=M('goods')->where('scate=66 and is_del=-1 and is_up=1')->select();
        //品牌策划
        $res['brand1']=M('brand')->limit(2)->select();
        $res['brand']=M('brand')->select();
        //企业礼品
        $res['qiye1']=M('goods')->where('scate=60 and is_del=-1 and is_up=1')->limit(2)->select();
        $res['qiye']=M('goods')->where('scate=60 and is_del=-1 and is_up=1')->select();
        //员工福利
        $res['fuli1']=M('goods')->where('scate=61 and is_del=-1 and is_up=1')->limit(2)->select();
        $res['fuli']=M('goods')->where('scate=61 and is_del=-1 and is_up=1')->select();
        //商城入口
        $res['shang1']=M('goods')->where('scate=68 and is_del=-1 and is_up=1')->limit(2)->select();
        $res['shang']=M('goods')->where('scate=68 and is_del=-1 and is_up=1')->select();
        //获取轮播图
        $res['advert'] = M("ad")->order("savetime desc")->select();//轮播
        foreach ($res['advert'] as $k=> $v) {
              $res['advert'][$k]['img2']='http://'.$_SERVER['SERVER_NAME'].$v['img'];
        }
        $return['stu'] = '1';
        $return['res'] = $res;
        $this->ajaxReturn($return);
    }

}