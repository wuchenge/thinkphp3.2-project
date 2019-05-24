<?php
// 本类由系统自动生成，仅供测试用途
namespace 	Home\Controller;
use Think\CommController\Controller;
class SpaceController extends BaseController {

    public function index(){
    	//参数获取
        $c1id= I('get.c1id');
        $c2id= I('get.c2id');
        $c3id= I('get.c3id');
        $title= I('get.title');
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
		$count=M('space')->where($map)->count();
		$Page = new \Think\Hpage($count,12);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show = $Page->show();// 分页显示输出
		$list=M('space')->where($map)->limit($Page->firstRow.','.$Page->listRows)->order('sort desc,addtime desc')->select();
		foreach ($list as $k=> $v) {
			//3个属性名称
			$list[$k]['c1name']=M('spacecate')->where('id='.$v['c1id'])->getField('title');
			$list[$k]['c2name']=M('spacecate')->where('id='.$v['c2id'])->getField('title');
			$list[$k]['c3name']=M('spacecate')->where('id='.$v['c3id'])->getField('title');
		}
		$this->assign("count",$count);
		$this->assign("list",$list);
		$this->assign('page',$show);
		$this->config['title']="办公空间推荐-".$this->config['title'];
		//分类
		$cate=M('spacecate')->where('pid=0')->select();
		foreach ($cate as $k=> $v) {
			//属性集合
			$cate[$k]['sumsx']=M('spacecate')->where('pid='.$v['id'])->select();
			
		}
		$banner=M('banner')->where('type=6')->select();
		$this->assign('banner',$banner);
        $this->assign("cate",$cate);
        $this->assign("config",$this->config);
		$this->display();
	}
//详情
	public function info(){
		$id = I('get.id/d');
		$danye = M("space")->find($id);
		if(!empty($_SESSION['uid'])){
			$data['uid']=$_SESSION['uid'];
			$data['gid']=$id;
			$data['type']=1;
			$collres=M('coll')->where($data)->find();
			if(empty($collres)){
				$danye['is_coll']=0;
			}else{
				$danye['is_coll']=1;
			}
		}else{
			$danye['is_coll']=0;
		}
		$danye['c1name']=M("spacecate")->where('id='.$danye['c1id'])->getField('title');
		$danye['c2name']=M("spacecate")->where('id='.$danye['c2id'])->getField('title');
		$danye['c3name']=M("spacecate")->where('id='.$danye['c3id'])->getField('title');
		$this->assign("danye",$danye);
		$imgjihe=explode('|',$danye['simgs']);
		$this->assign("imgjihe",$imgjihe);
		$this->config['keyword']=$danye['keywords'].','.$this->config["keyword"];
        $this->config['description']=$danye['description'].','.$this->config["description"];
        $this->config['title']=$danye['title']."-办公空间推荐-".$this->config['title'];
        $this->assign("config",$this->config);
		$this->display();
	}


}