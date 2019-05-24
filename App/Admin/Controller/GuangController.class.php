<?php
namespace Admin\Controller;
use Think\Controller;
class GuangController extends BaseController {
	/**
	*	资讯列表
	**/
    public function newsList(){
        //参数获取
//        $search['cate'] = I('get.cate');
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
            $map['xiutime'] = array('BETWEEN', array($search['start'], $search['end']));
        } else {
            $map['xiutime'] = array('LT', $search['end'] );
            // $map['addtime']      = array('lt', $search['end']-539162);
        }
        $map['bo'] = 0;
        $count=M('guang')->where($map)->count();
        $Page = new \Think\Page($count,20);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = M('guang')->where($map)->order('id')->limit($Page->firstRow.','.$Page->listRows)->
        select();
        foreach($list as $k=>$v){
            if(!empty($list[$k]['type'])){
//				dump($list[$k]['type']);
                $type=M('guangtype')->find($list[$k]['type']);
//				dump($type);
                $list[$k]['type']=$type['type'];
            }
        }
//        dump($list);
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('count',$count);// 赋值分页输出
//        dump($list);
        $this->display("guang/newslist");
    }

    /**
     *	资讯列表
     **/
    public function newsListbo(){
        //参数获取
//        $search['cate'] = I('get.cate');
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
            // $map['addtime']      = array('lt', $search['end']-539162);
        }
        $map['bo'] = 1;
        $count=M('guang')->where($map)->count();
        $Page = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性

        $list = M('guang')->where($map)->order('id')->limit($Page->firstRow.','.$Page->listRows)->
        select();
        foreach($list as $k=>$v){
            if(!empty($list[$k]['type'])){
//				dump($list[$k]['type']);
                $type=M('guangtype')->find($list[$k]['type']);
//				dump($type);
                $list[$k]['type']=$type['type'];
            }
        }
//        dump($list);
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('count',$count);// 赋值分页输出
//        dump($list);
        $this->display("guang/newslistbo");
    }

    /**
	*	资讯添加
	**/
    public function newsAdd(){
        if(!IS_POST){
//            dump($_GET['id']);
            if(!empty($_GET['id'])){
               $newsxiugl=M('guang')->where('bo = 1 ')->find($_GET['id']);
//                dump($newsxiugl);
            }
            $this->assign('newsxiugl',$newsxiugl);
            $this->display("guang/newsAddbo");
        }else{
//
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize  = 3145728 ;// 设置附件上传大小
            $upload->exts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->savePath =  '/news/';// 设置附件上传目录
            $upload->rootPath = './Public/uploads/'; // 设置附件上传根目录
            $info =  $upload->upload();
            if(!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            }
//            if(!$info['imgurlm']) {// 上传错误提示错误信息
//                $this->error('请上传手机版图片');
//            }
            $_POST['imgurl'] = '/Public/uploads'.$info['imgurl']['savepath'].$info['imgurl']['savename'];
            $_POST['addtime']=time();
            $_POST['addman']=$_SESSION['adminid'];
            $_POST['type']=1;
            $_POST['bo']=1;
            if(!preg_match("/^(\w+:\/\/)?\w+(\.\w+)+.*$/",$_POST['url'])){
                $this->error('请输入正确的网址');
            }
            $resule=M('guang')->add($_POST);
            if($resule){
                $this->success('新增图片成功',U('Guang/newsListbo'));exit;
            }else{
                $this->error('新增图片失败');
            }
        }
    }
   
    public function newsEdit(){
        if(!IS_POST){
            if(!empty($_GET['id'])){
                $newsxiugl=M('guang')->find($_GET['id']);
            }
            $this->assign('newsxiugl',$newsxiugl);
            $this->display("guang/newsAdd");
        }else{
            if(!empty($_POST['newid'])){
                if(!$_FILES['imgurl']['error'] ==4){
                    //删除编辑前的图片
                    $file=M('guang')->find($_POST['newid']);
                    $file = $file['imgurl'];
                    @unlink($_SERVER['DOCUMENT_ROOT'].$file);
                    $upload = new \Think\Upload();// 实例化上传类
                    $upload->maxSize  = 30145728 ;// 设置附件上传大小
                    $upload->exts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                    $upload->savePath =  '/news/';// 设置附件上传目录
                    $upload->rootPath = './Public/uploads/'; // 设置附件上传根目录
                    $info =  $upload->upload();
                    if(!$info) {// 上传错误提示错误信息
                        $this->error($upload->getError());
                    }
                    $_POST['imgurl'] = '/Public/uploads'.$info['imgurl']['savepath'].$info['imgurl']['savename'];
                }

                $_POST['xiutime']=time();
                if(!preg_match("/^(\w+:\/\/)?\w+(\.\w+)+.*$/",$_POST['url'])){
                    $this->error('请输入正确的网址');
                }
                $resule=M('guang')->where('id ='.$_POST['newid'])->save($_POST);
                if(!$resule==false){
                    $this->success('修改图片成功',U('Guang/newsList'));exit;
                }else{
                    $this->error('修改图片失败');
                }
            }else{
                $this->error('上传图片过大');
            }
        }
    }

    public function newsEditbo(){
        if(!IS_POST){
//            dump($_GET['id']);
            if(!empty($_GET['id'])){
                $newsxiugl=M('guang')->find($_GET['id']);
//                dump($newsxiugl);
            }
            $this->assign('newsxiugl',$newsxiugl);
            $this->display("guang/newsAddbo");
        }else{
//            dump($_POST);exit;
            if(!empty($_POST['newid'])){
//                dump($_FILES);exit;
                if(!$_FILES['imgurl']['error'] ==4){
                    //删除编辑前的图片
                    $file=M('guang')->find($_POST['newid']);
                    $file = $file['imgurl'];
                    @unlink($_SERVER['DOCUMENT_ROOT'].$file);
                    $upload = new \Think\Upload();// 实例化上传类
                    $upload->maxSize  = 30145728 ;// 设置附件上传大小
                    $upload->exts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                    $upload->savePath =  '/news/';// 设置附件上传目录
                    $upload->rootPath = './Public/uploads/'; // 设置附件上传根目录
                    $info =  $upload->upload();
                    if(!$info) {// 上传错误提示错误信息
                        $this->error($upload->getError());
                    }
                    $_POST['imgurl'] = '/Public/uploads'.$info['imgurl']['savepath'].$info['imgurl']['savename'];
                }
                $_POST['xiutime']=time();
                if(!preg_match("/^\S+$/",$_POST['title'])){
                $this->error('图片标题不能为空');
                }
                if(!preg_match("/^(\w+:\/\/)?\w+(\.\w+)+.*$/",$_POST['url'])){
                    $this->error('请输入正确的网址');
                }
                $resule=M('guang')->where('id ='.$_POST['newid'])->save($_POST);
                if(!$resule==false){
                    $this->success('修改图片成功',U('Guang/newsListbo'));exit;
                }else{
                    $this->error('修改图片失败');
                }
            }else{
                $this->error('上传图片过大');
            }
        }
    }
    
    /**
     *	删除图片
     **/
    public function delnews(){
        $nid=$_POST['id'];
        if(empty($nid)){
            $data['code']=0;
            $data['msg']="请选择要移除的图片信息";
            $this->ajaxReturn($data);
        }
        if(!is_numeric($nid)){
            $data['code']=0;
            $data['msg']="参数错误，请稍后再试";
            $this->ajaxReturn($data);
        }
        $addr=M('guang');
        $result=$addr->where('id ='.$nid.' AND bo != 0 ')->find();
        if($result){
            $deladdr=$addr->where('id ='.$nid.' AND bo != 0 ')->delete();
            if($deladdr){
                $data['code']=1;
                $data['msg']="删除图片信息成功";
                $this->ajaxReturn($data);
            }else{
                $data['code']=0;
                $data['msg']="删除图片信息失败";
                $this->ajaxReturn($data);
            }
        }else{
            $data['code']=0;
            $data['msg']="要删除的图片信息不存在或者不是轮播图";
            $this->ajaxReturn($data);
        }
//        dump($list);
    }


}