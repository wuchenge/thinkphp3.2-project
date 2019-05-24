<?php
namespace Home\Controller;
use Think\Controller;
class CouponController extends UserbaseController{
    
        //优惠券列表
    public function index(){
        $top="优惠券列表";
        $map['uid']=$_SESSION['uid'];
        $count=M('usercoupon')->where($map)->count();
        $Page = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        $result=M('usercoupon')->where($map)->limit($Page->firstRow.','.$Page->listRows)->order('addtime desc')->select();
        foreach($result as $k => $v){
            $result[$k]['money']=$v['money'];
            $result[$k]['limit']=$v['conditionm'];
        }
        $this->assign('top',$top);
        $this->assign('page',$show);
        $this->assign('result',$result);
        $this->display();
    }
    //未使用优惠券列表
    public function noused(){
        $top="未使用优惠券列表";
        $map['is_use']=-1;
        $map['end']=array('gt',time());
        $map['uid']=$_SESSION['uid'];
        $count=M('usercoupon')->where($map)->count();
        $Page = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        $result=M('usercoupon')->where($map)->limit($Page->firstRow.','.$Page->listRows)->order('addtime desc')->select();
        foreach($result as $k => $v){
            $result[$k]['limit']=$v['conditionm'];
        }
        $this->assign('top',$top);
        $this->assign('page',$show);
        $this->assign('result',$result);
        $this->display();
    }
        //已使用优惠券列表
    public function used(){
        $top="已使用优惠券列表";
        $map['is_use']=1;
        $map['uid']=$_SESSION['uid'];
        $count=M('usercoupon')->where($map)->count();
        $Page = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        $result=M('usercoupon')->where($map)->limit($Page->firstRow.','.$Page->listRows)->order('addtime desc')->select();
        foreach($result as $k => $v){
            $result[$k]['limit']=$v['conditionm'];
        }
        $this->assign('top',$top);
        $this->assign('page',$show);
        $this->assign('result',$result);
        $this->display();
    }
    //过期优惠券列表
    public function over(){
        $top="过期优惠券列表";
        $map['end']=array('lt',time());
        $map['uid']=$_SESSION['uid'];
        $map['is_use']=-1;
        $count=M('usercoupon')->where($map)->count();
        $Page = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        $result=M('usercoupon')->where($map)->limit($Page->firstRow.','.$Page->listRows)->order('addtime desc')->select();
        foreach($result as $k => $v){
            $result[$k]['limit']=$v['conditionm'];
        }
        $this->assign('top',$top);
        $this->assign('page',$show);
        $this->assign('result',$result);
        $this->display();
    }
    

 
}