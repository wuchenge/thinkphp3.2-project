<?php
// 本类由系统自动生成，仅供测试用途
namespace 	Home\Controller;
use Think\CommController\Controller;
class NewsController extends BaseController {

    public function index(){
		$count=M('news')->count();
		$Page = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show = $Page->show();// 分页显示输出
		$list=M('news')->limit($Page->firstRow.','.$Page->listRows)->order('addtime desc')->select();
		$list = M("news")->order('ordernum desc')->select();
		$this->assign("list",$list);
		$this->assign('page',$show);
		$this->config['title']="新闻中心-".$this->config['title'];
        $this->assign("config",$this->config);
		$this->display();
	}

	public function info(){
		$id = I('get.id/d');
		$danye = M("news")->field('title,num,id,addtime,text,keywords,description')->find($id);
		$this->assign("danye",$danye);
		$this->config['keyword']=$danye['keywords'].','.$this->config["keyword"];
        $this->config['description']=$danye['description'].','.$this->config["description"];
        $this->config['title']=$danye['title']."-新闻中心-".$this->config['title'];
        $this->assign("config",$this->config);
		$this->display();
	}


}