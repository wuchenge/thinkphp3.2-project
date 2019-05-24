<?php
// 本类由系统自动生成，仅供测试用途
namespace 	Home\Controller;
use Think\CommController\Controller;
class PlotController extends BaseController {

    public function index(){
		$count=M('brand')->count();
		$Page = new \Think\Page($count,30);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show = $Page->show();// 分页显示输出
		$list=M('brand')->limit($Page->firstRow.','.$Page->listRows)->order('sort desc,addtime desc')->select();
		$this->assign("list",$list);
		$this->assign('page',$show);
		$this->config['title']="品牌策划-".$this->config['title'];
        $this->assign("config",$this->config);
		$this->display();
	}

	public function info(){
		$id = I('get.id/d');
		$danye = M("brand")->find($id);
		$this->assign("danye",$danye);
		$imgjihe=explode('|',$danye['simgs']);
		$this->assign("imgjihe",$imgjihe);
		$this->config['keyword']=$danye['keywords'].','.$this->config["keyword"];
        $this->config['description']=$danye['description'].','.$this->config["description"];
        $this->config['title']=$danye['title']."-品牌策划-".$this->config['title'];
        $this->assign("danye",$danye);
        $this->assign("config",$this->config);
		$this->display();
	}


}