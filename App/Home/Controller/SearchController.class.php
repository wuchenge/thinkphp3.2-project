<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
class SearchController extends BaseController {
	//商品列表页面
    public function index(){
		$top='搜索页面';
		$this->display();
	}
	
	//搜索列表页面
    public function jglist(){
		$title=I('get.title');
		//搜索条件
		if(!empty($title)){
			$map['gname']=array('like','%'.$title.'%');
		}
		$map['type']=1;
		$map['is_del']=-1;
		$map['is_up']=1;
		$orderstr="sort desc,addtime desc";
		$count = M("goods")->where($map)->count();// 查询满足要求的总记录数
		$Page  = new \Think\Hpage($count,12);// 实例化分页类 传入总记录数和每页显示的记录数
		$show  = $Page->show();// 分页显示输出
		$list=M('goods')->where($map)->order($orderstr)->limit($Page->firstRow.','.$Page->listRows)->select();
		foreach ($list as  $k=>$v) {
			 $list[$k]['imgs']=explode('|',$v['imgurl2']);
		}
		$top='搜索商品';
		$this->assign('count',$count);
		$this->assign('list',$list);
		$this->assign('top',$top);
		$this->assign('page',$show);
		$this->display();
	}
	

}