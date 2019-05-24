<?php
// 本类由系统自动生成，仅供测试用途
namespace Api\Controller;
use Think\Controller;
class ConsultantController extends Controller {

    public function index(){
    	//参数获取
		$p = I('post.p');//页数
		if(empty($p)) $p = 1;
		$num=10;//每页数量
		$firstRow = ($p - 1) * $num;
		$orderstr="sort desc,addtime desc";
		$res=M('caifa')->order($orderstr)->limit($firstRow, $num)->select();
		foreach ($res as $k=> $v){
             $res[$k]['imgs']='https://'.$_SERVER['SERVER_NAME'].$v['imgurl'];
        }
        if(empty($res)){
			$return['stu'] = '0';
			$return['code'] = '111';
			$return['msg'] = '没有你要查询的数据';
			$this->ajaxReturn($return);
		}
		$return['stu'] = '1';
		$return['res'] = $res;
		$this->ajaxReturn($return);
	}

	public function info(){
		$id = I('post.id/d');
		$res = M("caifa")->find($id);
		if(empty($res)){
			$return['stu'] = '0';
			$return['code'] = '111';
			$return['msg'] = '没有你要查询的数据';
			$this->ajaxReturn($return);
		}
		$imgjihe=explode('|',$res['simgs']);
		foreach ($imgjihe as $k=>$v) {
			$res['imgjihe'][$k]='http://'.$_SERVER['SERVER_NAME'].$v;
		}
		$lujing='https://'.$_SERVER['SERVER_NAME'].'/ueditor';
		//详情里的图片
		$res['text']=str_replace("/ueditor",$lujing,$res['text']);
		//$lujing="http://".$_SERVER['SERVER_NAME']."/ueditor";
		//详情里的图片
		//$res['text']=str_replace("/ueditor",$lujing,$res['text']);
		//顾问
		$res['guwen']=M('config')->where('id=1')->field("gwname,ygwname,gwtel,wximgurl,gwimgurl")->find();
        $res['guwen']['wximgurl']='http://'.$_SERVER['SERVER_NAME'].$res['guwen']['wximgurl'];
        $res['guwen']['gwimgurl']='http://'.$_SERVER['SERVER_NAME'].$res['guwen']['gwimgurl'];
        $return['stu'] = '1';
		$return['res'] = $res;
		$this->ajaxReturn($return);
	}


}