<?php
namespace Home\Controller;
use Think\Controller;
class CollectController extends UserbaseController{
    
    //收藏的办公空间
    public function space(){
        $keyword=I('get.keyword');
         if(!empty($keyword)){
            $when['s.title'] = array('like','%'.$keyword.'%');
        }
        $when['c.uid']=$_SESSION['uid'];
        $when['c.type']=1;
        $count=M('coll')->table(array("xmb_coll"=>"c","xmb_space"=>"s"))->field("c.*,s.id as sid")->where($when)->where("s.id=c.gid")->count();
        $Page = new \Think\Hpage($count,16);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        $mycoll=M('coll')->table(array("xmb_coll"=>"c","xmb_space"=>"s"))->field("c.*,s.id as sid")->where($when)->where("s.id=c.gid")->limit($Page->firstRow.','.$Page->listRows)->select();
        foreach($mycoll as $k=>$v){
            $mycoll[$k]['space']=M('space')->where('id ='.$mycoll[$k]['gid'])->find();
        }
        $top="收藏商品";
        $this->assign('top',$top);
        $this->assign('mycoll',$mycoll);
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('count',$count);// 赋值分页输出
        $this->display();
    }
    //收藏商品
    public function product(){
        $keyword=I('get.keyword');
         if(!empty($keyword)){
            $when['s.gname'] = array('like','%'.$keyword.'%');
        }
        $when['c.uid']=$_SESSION['uid'];
        $when['c.type']=2;
        $count=M('coll')->table(array("xmb_coll"=>"c","xmb_goods"=>"s"))->field("c.*,s.id as sid")->where($when)->where("s.id=c.gid")->count();
        $Page = new \Think\Hpage($count,16);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        $mycoll=M('coll')->table(array("xmb_coll"=>"c","xmb_goods"=>"s"))->field("c.*,s.id as sid")->where($when)->where("s.id=c.gid")->limit($Page->firstRow.','.$Page->listRows)->select();
        foreach($mycoll as $k=>$v){
            $mycoll[$k]['goods']=M('goods')->where('id ='.$mycoll[$k]['gid'])->find();
        }
        $top="收藏商品";
        $this->assign('top',$top);
        $this->assign('mycoll',$mycoll);
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('count',$count);// 赋值分页输出
        $this->display();
    }
    //收藏商品
    public function docoll(){
        $shou['gid'] = I("post.gid");
        if(empty($shou['gid'])){
            $data['status'] = 0;
            $data['msg'] = "收藏商品失败！";
            $this->ajaxReturn($data);
        }
        $shou['addtime']=time();
        $shou['uid']=$_SESSION['uid'];
        $shou['type']=2;
        $result = M("coll")->add($shou);
        if($result){
            $data['status'] = 1;
            $data['msg'] = "收藏商品成功！";
            $this->ajaxReturn($data);
        }else{
            $data['status'] = 0;
            $data['msg'] = "收藏商品失败！";
            $this->ajaxReturn($data);
        }
    }
    //删除收藏
    public function bucoll(){
        $when['gid'] = I("post.gid");
        if(empty($when['gid'])){
            $data['status'] = 0;
            $data['msg'] = "取消收藏失败！";
            $this->ajaxReturn($data);
        }
		$when['uid']=$_SESSION['uid'];
        $when['type']=2;
        $result = M("coll")->where($when)->delete();
        if($result){
            $data['status'] = 1;
            $data['msg'] = "取消收藏成功！";
            $this->ajaxReturn($data);
        }else{
            $data['status'] = 0;
            $data['msg'] = "取消收藏失败！";
            $this->ajaxReturn($data);
        }
    }
       //收藏办公空间
    public function docoll2(){
        $user['gid'] = I("post.gid");
        if(empty($user['gid'])){
            $data['status'] = 0;
            $data['msg'] = "收藏办公空间失败！";
            $this->ajaxReturn($data);
        }
        $user['addtime']=time();
        $user['uid']=$_SESSION['uid'];
        $user['type']=1;
        $result = M("coll")->add($user);
        if($result){
            $data['status'] = 1;
            $data['msg'] = "收藏办公空间成功！";
            $this->ajaxReturn($data);
        }else{
            $data['status'] = 0;
            $data['msg'] = "收藏办公空间失败！";
            $this->ajaxReturn($data);
        }
    }
    //删除收藏空间
    public function bucoll2(){
        $when['gid'] = I("post.gid");
        if(empty($when['id'])){
            $data['status'] = 0;
            $data['msg'] = "收藏商品失败！";
            $this->ajaxReturn($data);
        }
        $when['uid']=$_SESSION['uid'];
        $when['type']=1;
        $result = M("coll")->where($when)->delete();
        if($result){
            $data['status'] = 1;
            $data['msg'] = "取消收藏成功！";
            $this->ajaxReturn($data);
        }else{
            $data['status'] = 0;
            $data['msg'] = "取消收藏失败！";
            $this->ajaxReturn($data);
        }
    }
    //批量
    public function delmuti(){
        $ids = I('post.ids');
        $where['id']=array('in',$ids);
        $news = M('coll')->where($where)->select();
        $result = M('coll')->where($where)->delete();
        if($news){
            if($result){
                $data['status'] = 1;
                $data['msg'] = "删除成功！";
                $this->ajaxReturn($data);
            }else{
                $data['status'] = 0;
                $data['msg'] = "删除失败！";
                $this->ajaxReturn($data);
            }
        }else{
            $data['status'] = 0;
            $data['msg'] = "数据不存在！";
            $this->ajaxReturn($data);
        }
    }
 
}