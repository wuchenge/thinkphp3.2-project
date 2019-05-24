<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
class BaseController extends Controller {
	public function __construct(){
		parent::__construct();  //调用父构造函数避免冲突
		$this->config = M("Config")->where("id = 1")->find();
		$this->assign("config",$this->config);
		//获取三级分类
		$cate=M('productcate')->field('id,title')->where('pid = 0')->order('ordernum desc')->limit(7)->select();
		foreach($cate as $k  => $v){
			//动态传递参数
			$cate[$k]['name'] = "cate_".$v['id'];
			$l =M('productcate')->field('id,title')->where('pid = '.$v['id'])->order('ordernum desc')->select();
			foreach($l as $k1  => $v1){
				$l[$k1]['nameth'] = "cateth_".$v1['id'];//循环里边需要的k是变的
				$lth =M('productcate')->field('id,title')->where('pid = '.$v1['id'])->order('ordernum desc')->select();
				$this->assign("cateth_".$v1['id'],$lth);
			}
			$this->assign("cate_".$v['id'],$l);
		}
		$this->assign('cate',$cate);
		// //网站配置信息
		// if(empty($_SESSION['config']['title'])){
		// 	$_SESSION['config']=M('config')->find(1);
		// }
		// $this->assign('config',$_SESSION['config']);
		// dump($data);die;
		//显示购物车商品数量
		$cartM = M('cart c');
		if(empty($_SESSION['uid'])){
			$num=$data['num'] = $cartM->join(C('DB_PREFIX').'goods g on c.gid=g.id','LEFT')->where('cid="'.$_COOKIE['cid'].'" AND is_del =-1 AND is_up =1 ')->count();
			$this->assign('cart_num',$num);
		}else{
			$num=$cartM->join(C('DB_PREFIX').'goods g on c.gid=g.id','LEFT')->where('uid ='.$_SESSION['uid'].' AND is_del =-1 AND is_up =1')->count();
			$this->assign('cart_num',$num);
		}

        //办公空间推荐
        $kongjian=M('space')->order('sort desc,addtime desc')->limit(5)->select();
        $this->assign('kongjian',$kongjian);
        //办公空间维护‘
        $weihu=M('productcate')->where('pid = 59')->limit(4)->select();
        $this->assign('weihu',$weihu);
        //精选商城
        $jingxuan=M('productcate')->where('pid = 68')->limit(4)->select();
        $this->assign('jingxuan',$jingxuan);
	}

}
