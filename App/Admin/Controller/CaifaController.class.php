<?php
namespace Admin\Controller;
use Think\Controller;
class CaifaController extends BaseController {
	/**
	*	财税法学列表
	**/
    public function lists(){
        //参数获取
        $search['end'] = I('get.end');
        $search['start'] = I('get.start');
        $search['title'] = I('get.title');
//        dump($search);
        if(!empty($search['title'])){
            $map['title'] = array('like', '%' . $search['title'] . '%');
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
        $count=M('caifa')->where($map)->count();
        $Page = adminpage($count,10);
       // $Page = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = M('caifa')->where($map)->order('addtime desc')->limit($Page->firstRow.','.$Page->listRows)->
        select();
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('count',$count);// 赋值分页输出
        $this->display("Caifa/lists");
    }
    /**
	*	财税法学添加
	**/
    public function add(){
        if(!IS_POST){
            if(!empty($_GET['id'])){
               $newsxiugl=M('caifa')->find($_GET['id']);
            }
            $this->assign('newsxiugl',$newsxiugl);
            $this->display("Caifa/add");
        }else{
            $news = M('caifa');
            $news->create();
            $stime=I('post.addtime');
            if(empty($stime)){
                $news->addtime = time();
            }else{
                $news->addtime = strtotime($stime);
            }
            $imgurlglgo=I('post.imgurlglgo');
            if(empty($imgurlglgo)){
                    $this->error('请您上传商品图');
            }
            $price=I('post.price');
            if(empty($price)){
                    $this->error('请您上传价格');
            }
            $news->price=I('post.price');
            $news->imgurl=$imgurlglgo[0];
            $imgurlgl=I('post.imgurlgl');
            if(empty($imgurlgl)){
                    $this->error('请您上传商品细节图');
            }
            $news->simgs= implode('|',$imgurlgl);
            $result = $news->add();
            if($result){
                $this->success('新增财税法学成功',U('Caifa/lists'));
            }else{
                $this->error('新增财税法学失败，请稍候操作');
            }
        }
    }

    public function edit(){
        if(!IS_POST){
            if(!empty($_GET['id'])){
                $newsxiugl=M('caifa')->find($_GET['id']);
            }

            $newsxiugl = M('caifa')->where("id = ".$_GET['id'])->find();
            $imgroll=explode('|',$newsxiugl['simgs']);
            $this->assign('imgroll',$imgroll);
            if($newsxiugl){
                $this->assign('newsxiugl',$newsxiugl);
                $this->display("Caifa/edit");
            }else{
                $this->error('该数据不存在');
            }
        }else{
            $news = M('caifa');
            $news->create();
            //财税法学修改时间处理
            $news->addtime = strtotime(I('post.addtime'));
            $price=I('post.price');
            if(empty($price)){
                    $this->error('请您上传价格');
            }else{
                $news->price=I('post.price');
            }
            $imgurlglgo=I('post.imgurlglgo');
            $imgurlgl=I('post.imgurlgl');
           if(!empty($imgurlglgo)){
                //删除编辑前的图片
                $file=M('goods')->find($id);
                $file = $file['imgurl'];
                @unlink($_SERVER['DOCUMENT_ROOT'].$file);
                $news->imgurl= $imgurlglgo[0];
            }
            if(!empty($imgurlgl)){
                //删除编辑前的图片
                $file=M('goods')->find($id);
                $file = $file['imgurl2'];
                @unlink($_SERVER['DOCUMENT_ROOT'].$file);
                $news->simgs= implode('|',$imgurlgl);
            }
            $result = $news->save();
            if($result !== false){
                $this->success('财税法学修改成功',U("Caifa/lists"));
            }else{
                $this->error('财税法学修改失败，请稍候操作');
            }
        }
    }
    /**
     *	删除财税法学
     **/
    public function del(){
        $nid=$_POST['id'];
        if(empty($nid)){
            $data['code']=0;
            $data['msg']="请选择要移除的财税法学信息";
            $this->ajaxReturn($data);
        }
        if(!is_numeric($nid)){
            $data['code']=0;
            $data['msg']="参数错误，请稍后再试";
            $this->ajaxReturn($data);
        }
        $addr=M('caifa');
        $result=$addr->where('id ='.$nid)->find();
        if($result){
            $deladdr=$addr->where('id ='.$nid)->delete();
            if($deladdr){
                $data['code']=1;
                $data['msg']="删除财税法学信息成功";
                $this->ajaxReturn($data);
            }else{
                $data['code']=0;
                $data['msg']="删除财税法学信息失败";
                $this->ajaxReturn($data);
            }
        }else{
            $data['code']=0;
            $data['msg']="要删除的财税法学信息不存在";
            $this->ajaxReturn($data);
        }
    }

}