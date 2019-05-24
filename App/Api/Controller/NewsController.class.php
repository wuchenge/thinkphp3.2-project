<?php
// 本类由系统自动生成，仅供测试用途
namespace Api\Controller;
use Think\Controller;
class NewsController extends Controller {

    public function index(){
		//参数获取
		$p = I('post.p');//页数
		if(empty($p)) $p = 1;
		$num=10;//每页数量
		$firstRow = ($p - 1) * $num;
		$orderstr="ordernum desc,addtime desc";

		$res=M('news')->order($orderstr)->limit($firstRow, $num)->select();
        if(empty($res)){
			$return['stu'] = '0';
			$return['code'] = '111';
			$return['msg'] = '没有你要查询的数据';
			$this->ajaxReturn($return);
		}
        foreach ($res as $k=>$v) {
        	$res[$k]['img2']='http://'.$_SERVER['SERVER_NAME'].$v['imgurl'];
        }
		$return['stu'] = '1';
		$return['res'] = $res;
		$this->ajaxReturn($return);
	}

	public function info(){
		$id = I('post.id/d');
		$res = M("news")->field('title,num,id,addtime,text,keywords,description')->find($id);
        if(empty($res)){
			$return['stu'] = '0';
			$return['code'] = '111';
			$return['msg'] = '没有你要查询的数据';
			$this->ajaxReturn($return);
		}
		$lujing='https://'.$_SERVER['SERVER_NAME'].'/ueditor';
		//详情里的图片
		$res['text']=str_replace("/ueditor",$lujing,$res['text']);
		$return['stu'] = '1';
		$return['res'] = $res;
		$this->ajaxReturn($return);
	}


}