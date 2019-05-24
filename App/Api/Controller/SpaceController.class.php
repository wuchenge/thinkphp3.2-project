<?php
// 本类由系统自动生成，仅供测试用途
namespace Api\Controller;
use Think\Controller;
class SpaceController extends Controller {

    public function index(){
    	//参数获取
        $c1id= I('post.c1id');
        $c2id= I('post.c2id');
        $c3id= I('post.c3id');
        $title= I('post.title');
        if(!empty($c1id)){
            $map['c1id'] =$c1id;
        }
        if(!empty($c2id)){
            $map['c2id'] =$c2id;
        }
        if(!empty($c3id)){
            $map['c3id'] =$c3id;
        }
        if(!empty($title)){
            $map['title'] = array('like', '%' . $title . '%');
        }
        //参数获取
		$p = I('post.p');//页数
		if(empty($p)) $p = 1;
		$num=10;//每页数量
		$firstRow = ($p - 1) * $num;
		$orderstr="sort desc,addtime desc";

		$res['list']=M('space')
				->where($map)
				->order($orderstr)
				->limit($firstRow, $num)
				->select();
		if(empty($res['list'])){
			$return['stu'] = '0';
			$return['code'] = '111';
			$return['msg'] = '没有你要查询的数据';
			$this->ajaxReturn($return);
		}
		foreach ($res['list'] as $k=> $v) {
			//3个属性名称
			$res['list'][$k]['c1name']=M('spacecate')->where('id='.$v['c1id'])->getField('title');
			$res['list'][$k]['c2name']=M('spacecate')->where('id='.$v['c2id'])->getField('title');
			$res['list'][$k]['c3name']=M('spacecate')->where('id='.$v['c3id'])->getField('title');
			$res['list'][$k]['imgs2']='https://'.$_SERVER['SERVER_NAME'].$v['imgurl'];
		}
		//分类
		$res['cate']=M('spacecate')->where('pid=0')->select();
		foreach ($res['cate'] as $k=> $v) {
			//属性集合
			$res['cate'][$k]['sumsx']=M('spacecate')->where('pid='.$v['id'])->select();
		}
		$res['banner']=M('banner')->where('type=6')->select();
		foreach ($res['banner'] as $k=> $v){
             $res['banner'][$k]['img4']='https://'.$_SERVER['SERVER_NAME'].$v['img'];
        }
        $return['stu'] = '1';
		$return['res'] = $res;
		$this->ajaxReturn($return);
	}
//详情
	public function info(){
		$id = I('post.id/d');
		$res = M("space")->find($id);
		if(!$res){
            $return['stu'] = '0';
			$return['code'] = '111';
			$return['msg'] = '信息不存在';
			$this->ajaxReturn($return);
		}
		$res['c1name']=M("spacecate")->where('id='.$res['c1id'])->getField('title');
		$res['c2name']=M("spacecate")->where('id='.$res['c2id'])->getField('title');
		$res['c3name']=M("spacecate")->where('id='.$res['c3id'])->getField('title');

		$imgjihe=explode('|',$res['simgs']);
		foreach ($imgjihe as $k=>$v) {
			$res['imgjihe'][$k]='http://'.$_SERVER['SERVER_NAME'].$v;
		}
		$lujing="http://".$_SERVER['SERVER_NAME']."/ueditor";
		//详情里的图片
		$res['text']=str_replace("/ueditor",$lujing,$res['text']);
		//顾问
		$res['guwen']=M('config')->where('id=1')->field("gwname,ygwname,gwtel,wximgurl,gwimgurl")->find();
        $res['guwen']['wximgurl']='http://'.$_SERVER['SERVER_NAME'].$res['guwen']['wximgurl'];
        $res['guwen']['gwimgurl']='http://'.$_SERVER['SERVER_NAME'].$res['guwen']['gwimgurl'];
        $return['stu'] = '1';
		$return['res'] =$res;
		$this->ajaxReturn($return);
	}


}