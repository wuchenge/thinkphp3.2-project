<?php
// 本类由系统自动生成，仅供测试用途
namespace Api\Controller;
use Think\Controller;
class SearchController extends Controller {

	//搜索列表页面
    public function index(){
		$title=I('post.title');
		//搜索条件
		if(!empty($title)){
			$map['gname']=array('like','%'.$title.'%');
		}
		$map['type']=1;
		$map['is_del']=-1;
		$map['is_up']=1;
		// //参数获取
		// $p = I('post.p');//页数
		// if(empty($p)) $p = 1;
		// $num=10;//每页数量
		// $firstRow = ($p - 1) * $num;
		$orderstr="sort desc,addtime desc";

		//$res=M('goods')->where($map)->order($orderstr)->limit($firstRow, $num)->select();
		$res=M('goods')->where($map)->order($orderstr)->select();
		foreach ($res as  $k=>$v) {
			  $res[$k]['imgs2']='https://'.$_SERVER['SERVER_NAME'].$v['imgurl'];
			 // $res[$k]['imgs']=explode('|',$v['imgurl2']);
			 // foreach ($res[$k]['imgs'] as $k2=> $v2) {
    //           $res[$k]['imgs'][$k2]='https://'.$_SERVER['SERVER_NAME'].$v2;
    //        }
		}
		$return['stu'] = '1';
		$return['res'] = $res;
		$this->ajaxReturn($return);
	}
	

}