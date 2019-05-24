<?php
namespace Admin\Controller;
use Think\Controller;
class CouponController extends BaseController {
	/**
	*	板块添加
	*/
	public function typeAdd(){
		if(IS_POST){
			$title=I('post.title');
			$note=I('post.note');
			if(empty($title)){
				$this->error('分类名称不能为空');
			}
			
			if(empty($note)){
				$this->error('分类备注不能为空');
			}
			$map['title']=$title;
			$map['is_open']=I('post.is_open');
			$map['addtime']=time();
			$map['note']=$note;
			$result=M('cpcate')->add($map);
			if($result){
				$this -> success("分类添加成功",U("typeList"));
			}else{
				$this->error('分类添加失败');
			}
		}else{
			$this -> display();
		}
	}
	
	public function typeList(){
		$map['is_del']=-1;
		$count = M("cpcate")->where($map) -> count();
    	$Page  = new \Think\Page($count,10);
    	$Page->setConfig('prev','上一页');
    	$Page->setConfig('next','下一页');
    	$Page->setConfig('first','首页');
    	$Page->setConfig('last','尾页');
    	$show  = $Page->show();
    	$list = M("cpcate")->where($map)->limit($Page->firstRow.','.$Page->listRows)->select();
		$this -> assign("page",$show);
		$this -> assign("list",$list);
		$this -> display();
	}
	public function typeDel(){
		$result=M("coupon")->where('cid ='.$_GET['id'])->select();
		if($result != null){
			$data["status"]=0;
			$data["msg"]="该分类下有优惠券，请删除优惠券再删除该分类！";
			$this->ajaxReturn($data);
		}
		if(M("cpcate")->where('id ='.$_GET['id'])->setField('is_del',1)){
			$data["status"]=1;
			$data["msg"]="删除成功";
			$this->ajaxReturn($data);
		}else{
			$data["status"]=0;
			$data["msg"]="删除失败";
			$this->ajaxReturn($data);
		}
	}
	//软件分区修改
	public function typeedit(){
		if(IS_POST){
			$title=I('post.title');
			$note=I('post.note');
			$id=I('post.id');
			if(empty($id)){
				$this->error('分类id不能为空');
			}
			if(empty($title)){
				$this->error('分类名称不能为空');
			}
			
			if(empty($note)){
				$this->error('分类备注不能为空');
			}
			$map['title']=$title;
			$map['is_open']=I('post.is_open');
			$map['note']=$note;
			$map['id']=$id;
			$result=M('cpcate')->save($map);
			if($result){
				$this -> success("分类修改成功",U("typeList"));
			}else{
				$this->error('分类修改失败');
			}
		}else{
			$fd = M("cpcate") -> find($_GET['id']);
			$this -> assign("fd",$fd);
			$this -> display();
		}
	}
	//优惠券列表修改
	public function couponedit(){
		if(IS_POST){
			$money=I('post.money');
			$condition=I('post.condition');
			if(empty($money)){
				$this->error('减免金额不能为空');
			}
			
			if(empty($condition)){
				$this->error('使用条件金额不能为空');
			}
			$map['money']=$money;
			$map['id']=I('post.id');
			$map['is_open']=I('post.is_open');
			$map['condition']=$condition;
			$map['start']=strtotime(I('post.start'));
			$map['end']=strtotime(I('post.end'));
			$map['uid']=$_SESSION['adminid'];
			$result=M('coupon')->save($map);
			if($result){
				$this -> success("优惠券修改成功",U("couponList"));
			}else{
				$this->error('优惠券修改失败');
			}
		}else{
			$fd = M("coupon") -> find($_GET['id']);
			$this -> assign("fd",$fd);
			$this -> display();
		}
	}
	
	public function couponList(){
		$map['is_del']=-1;
		$count = M("coupon")->where($map) -> count();
		$Page = adminpage($count,10);
    	//$Page  = new \Think\Page($count,10);
    	$Page->setConfig('prev','上一页');
    	$Page->setConfig('next','下一页');
    	$Page->setConfig('first','首页');
    	$Page->setConfig('last','尾页');
    	$show  = $Page->show();
    	$list = M("coupon")->where($map)->limit($Page->firstRow.','.$Page->listRows)->order('cid desc,money desc')->select();
		foreach($list as $key=>$val){
			$list[$key]['cpcate']=M('cpcate')->where('id ='.$val['cid'])->getField('title');
			$list[$key]['adname']=M('admin')->where('id ='.$val['uid'])->getField('username');
		}
		// dump($list);die;
		$this -> assign("page",$show);
		$this -> assign("list",$list);
		$this -> display();
	}
	
//用户优惠券列表
	public function usercouponList(){
		//参数获取
        $search['end'] = I('get.end');
        $search['start'] = I('get.start');
        $search['title'] = I('get.title');
		//$map['is_del']=-1;
        if(!empty($search['title'])){
            $map['uname'] = array('like', '%' . $search['title'] . '%');
        }
        $this->assign('search',$search);// 赋值分页输出
        // 查询条件（结束时间）设置
        if (!empty($search['end'])) {
            $search['end'] = strtotime($search['end']) + 86399;
        } else {
            $search['end'] = time();
        }
        // 查询条件（开始时间）设置
        if (!empty($search['start'])) {
            $search['start'] = strtotime($search['start']);
            if($search['start'] > $search['end']){
                $this->error('开始时间不能大于结束时间');
            }
            $map['addtime'] = array('BETWEEN', array($search['start'], $search['end']));
        } else {
            $map['addtime'] = array('LT', $search['end'] );
        }
		$count = M("usercoupon")->where($map) -> count();
		$Page = adminpage($count,10);
    	//$Page  = new \Think\Page($count,10);
    	$show  = $Page->show();
		
    	$list = M("usercoupon")->where($map)->limit($Page->firstRow.','.$Page->listRows)->order('addtime desc')->select();
		foreach($list as $key=>$val){
			$list[$key]['adname']=$val['uname'];
			$list[$key]['condition']=$val['conditionm'];
			$list[$key]['money']=$val['money'];
			$list[$key]['start']=$val['start'];
			$list[$key]['end']=$val['end'];
			if(!empty($val['bid'])){
				$list[$key]['boid']=M('order')->where('id ='.$val['bid'])->getField('orderid');
			}
			$list[$key]['cate']=M('cpcate')->where('id ='.$val['cid'])->getField('title');
		}
		$this -> assign("page",$show);
		$this -> assign("list",$list);
		$this -> display();
	}

	
	//优惠券删除
	public function couponDel(){
		$result=M("coupon")->where('id ='.$_GET['id'])->getField('is_del');
		if($result == 1){
			$data["status"]=0;
			$data["msg"]="该优惠券已删除！";
			$this->ajaxReturn($data);
		}
		if(M("coupon")->where('id ='.$_GET['id'])->setField('is_del',1)){
			$data["status"]=1;
			$data["msg"]="删除成功";
			$this->ajaxReturn($data);
		}else{
			$data["status"]=0;
			$data["msg"]="删除失败";
			$this->ajaxReturn($data);
		}
	}
	public function couponAdd(){
		if(IS_POST){
			$money=I('post.money');
			$condition=I('post.condition');
			if(empty($money)){
				$this->error('减免金额不能为空');
			}
			
			if(empty($condition)){
				$this->error('使用条件金额不能为空');
			}
			$map['money']=$money;
			$map['condition']=$condition;
			$map['start']=strtotime(I('post.start'));
			$map['end']=strtotime(I('post.end'));
			$map['cid']=I('post.cid');
			$map['addtime']=time();
			$result=M('coupon')->add($map);
			if($result){
				$this -> success("优惠券添加成功",U("couponList"));
			}else{
				$this->error('优惠券添加失败');
			}
		}else{
			$list = M("cpcate") -> select();
			$this -> assign("list",$list);
			$this -> display();
		}
	}
}