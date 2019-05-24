<?php
// 本类由系统自动生成，仅供测试用途
namespace 	Home\Controller;
use Think\CommController\Controller;
class DanyeController extends BaseController {
	public function about(){
		$danye_id = I('get.danye_id/d');
		$danye_cid = I('get.danye_cid/d');
		$danye = M("Danye")->field('title,id,content')->find($danye_id);

		$danye_cate = M("dy_cate")->find($danye_cid);
		$danye['content'] = html_entity_decode($danye['content']);
		$this->assign("danye",$danye);
		$this->assign("danye_cate",$danye_cate);
		$this->assign('top',$danye['title'].'｜'.$danye_cate['title']);
		$this->display();
	}

	public function news(){
		$id = I('get.id/d');
		$danye = M("news")->field('title,num,addtime,id,text,cate_id,keywords,description')->find($id);
		$url = 'newsurl' . $id;//防止刷浏览量
		if (empty($_COOKIE[$url])) {
			M('news')->where("id = ".$id)->setInc('num',1);
			setcookie($url, $_SERVER['PHP_SELF'], time() + 300);
		}
		$newscate=M('news_cate')->find($danye['cate_id']);//获取
		$cate=$newscate['cate_name'];//导航显示
		$danye['text'] = html_entity_decode($danye['text']);
		//左侧菜单栏
		$newscate=M('news_cate')->order('ordernum desc')->select();
		$this->assign("newscate",$newscate);
		$this->assign("danye",$danye);
		$this->assign("cate",$cate);//导航显示
		$this->assign('top',$danye['title']);
		$this->display();
	}

	public function lists(){
		$id = I('get.id/d');
		if(!empty($id)){
			$map['cate_id']=$id;
		}
		$count=M('news')->where($map)->count();
		$Page = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show = $Page->show();// 分页显示输出
		$list=M('news')->where($map)->limit($Page->firstRow.','.$Page->listRows)->order('addtime desc')->select();
		$danye = M("news")->field('title,id,text,cate_id,keywords,description')->find($id);
		$seo=M('news_cate')->find($id);
		$cate=$seo['cate_name'];
		if(empty($seo)){
			$seo['title']='新闻中心-全部新闻';
			$cate='全部新闻';
		}
		
		$danye['text'] = html_entity_decode($danye['text']);
		//左侧菜单栏
		$newscate=M('news_cate')->order('ordernum desc')->select();
		$this->assign("newscate",$newscate);
		$this->assign("list",$list);
		$this->assign("cate",$cate);
		$this->assign('top',$seo['title']);//新闻头部优化信息
		$this->assign('page',$show);
		$this->display();
	}
}