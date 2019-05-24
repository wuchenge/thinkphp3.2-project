<?php
namespace Admin\Controller;
use Think\Controller;
class MessageController extends BaseController {
	/**
	*	留言中心
	**/
    public function lists(){
        //参数获取
        $search['end'] = I('get.end');
        $search['start'] = I('get.start');
        $search['title'] = I('get.title');
        if(!empty($search['title'])){
            $map['name'] = array('like', '%' . $search['title'] . '%');
        }
        $this->assign('search',$search);// 赋值分页输出
        // 查询条件（结束时间）设置
        if (!empty($search['end'])) {
            $search['end'] = strtotime($search['end']) + 86399;
        }else{
            $search['end'] = time();
        }
        $map['status'] = 0;
        // 查询条件（开始时间）设置
        if (!empty($search['start'])) {
            $search['start'] = strtotime($search['start']);
            if($search['start'] > $search['end']){
                $this->error('开始时间不能大于结束时间');
            }
            $map['addtime'] = array('BETWEEN', array($search['start'], $search['end']));
        } else {
            $map['addtime'] = array('LT', $search['end'] );
            // $map['addtime']      = array('lt', $search['end']-539162);
        }
        $count=M('message')->where($map)->count();
        $Page = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = M('message')->where($map)->order('addtime desc','xiutime desc')->limit($Page->firstRow.','.$Page->listRows)->
        select();
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('count',$count);// 赋值分页输出
        $this->display("Message/lists");
    }

   //回复留言
    public function edit(){
        if(!IS_POST){
            if(!empty($_GET['id'])){
                $newsxiugl=M('message')->find($_GET['id']);
            }
            $newsxiugl = M("message")->where("id = ".$_GET['id'])->find();
            if($newsxiugl){
                $this->assign('newsxiugl',$newsxiugl);
                $this->display("Message/edit");
            }else{
                $this->error('该数据不存在');
            }
        }else{
            $news = M("message");
            $news->create();
            //留言修改时间处理
           if(!empty($_POST['addtime'])){
               $news->addtime = strtotime($_POST['addtime']);
           }
            $result = $news->save();
            if($result !== false){
                $this->success('留言回复成功',U("Message/lists"));
            }else{
                $this->error('留言回复失败，请稍候操作');
            }
        }
    }
    /**
     *	删除留言
     **/
    public function delnews(){
        $nid=$_POST['id'];
        if(empty($nid)){
            $data['code']=0;
            $data['msg']="请选择要移除的留言信息";
            $this->ajaxReturn($data);
        }
        if(!is_numeric($nid)){
            $data['code']=0;
            $data['msg']="参数错误，请稍后再试";
            $this->ajaxReturn($data);
        }
        $addr=M('message');
        $result=$addr->where('id ='.$nid)->find();
        if($result){
            $deladdr=$addr->where('id ='.$nid)->delete();
            if($deladdr){
                $data['code']=1;
                $data['msg']="删除留言信息成功";
                $this->ajaxReturn($data);
            }else{
                $data['code']=0;
                $data['msg']="删除留言信息失败";
                $this->ajaxReturn($data);
            }
        }else{
            $data['code']=0;
            $data['msg']="要删除的留言信息不存在";
            $this->ajaxReturn($data);
        }
    }

}