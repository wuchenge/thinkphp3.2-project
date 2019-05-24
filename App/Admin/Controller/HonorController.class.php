<?php
namespace Admin\Controller;
use Think\Controller;
class HonorController extends BaseController {
	/**
	*	荣誉列表
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
        $count=M('honor')->where($map)->count();
        $Page = adminpage($count,10);
        //$Page = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = M('honor')->where($map)->order('addtime desc')->limit($Page->firstRow.','.$Page->listRows)->
        select();
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('count',$count);// 赋值分页输出
        $this->display("Honor/lists");
    }
    /**
	*	荣誉添加
	**/
    public function add(){
        if(!IS_POST){
            if(!empty($_GET['id'])){
               $newsxiugl=M('honor')->find($_GET['id']);
            }
            $this->assign('newsxiugl',$newsxiugl);
            $this->display("Honor/add");
        }else{
            $news = M("honor");
            $news->create();
            $stime=I('post.addtime');
            if(empty($stime)){
                $news->addtime = time();
            }else{
                $news->addtime = strtotime($stime);
            }
            if(!$_FILES['image']['name']){
                $this->error('图片不能为空');
            }
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize  = 1024000 ;// 设置附件上传大小
            $upload->exts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->savePath =  '/Honor/';// 设置附件上传目录
            $upload->autoCheck =  false;
            $info =  $upload->upload();
            if(!$info){
                // 上传错误提示错误信息
                $this->error($upload->getError());
            }
            $tu= '/Public/uploads'.$info['image']['savepath'].$info['image']['savename'];
            $image= new \Think\Image();
            $image->open(".".$tu);
            $image->thumb(384, 378,\Think\Image::IMAGE_THUMB_FIXED)->save(".".$tu);
            $news->imgurl=$tu;
            $result = $news->add();
            if($result){
                $this->success('新增荣誉成功',U('Honor/lists'));
            }else{
                $this->error('新增荣誉失败，请稍候操作');
            }
        }
    }

    public function edit(){
        if(!IS_POST){
            if(!empty($_GET['id'])){
                $newsxiugl=M('honor')->find($_GET['id']);
            }

            $newsxiugl = M("honor")->where("id = ".$_GET['id'])->find();
            if($newsxiugl){
                $this->assign('newsxiugl',$newsxiugl);
                $this->display("Honor/edit");
            }else{
                $this->error('该数据不存在');
            }
        }else{
            $news = M("honor");
            $news->create();
            //荣誉修改时间处理
            $news->addtime = strtotime(I('post.addtime'));
            if($_FILES['image']['name']){
                    $upload = new \Think\Upload();// 实例化上传类
                    $upload->maxSize  = 1024000 ;// 设置附件上传大小
                    $upload->exts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                    $upload->savePath =  '/Honor/';// 设置附件上传目录
                    $upload->autoCheck =  false;
                    $info =  $upload->upload();
                    if(!$info){
                        // 上传错误提示错误信息
                        $this->error($upload->getError());
                    }
                    $tu= '/Public/uploads'.$info['image']['savepath'].$info['image']['savename'];
                    $image = new \Think\Image();
                    $image->open(".".$tu);
                    $image->thumb(384, 378,\Think\Image::IMAGE_THUMB_FIXED)->save(".".$tu);
                    $news->imgurl=$tu;
            }
           
            $result = $news->save();
            if($result !== false){
                $this->success('荣誉修改成功',U("Honor/lists"));
            }else{
                $this->error('荣誉修改失败，请稍候操作');
            }
        }
    }
    /**
     *	删除荣誉
     **/
    public function delnews(){
        $nid=$_POST['id'];
        if(empty($nid)){
            $data['code']=0;
            $data['msg']="请选择要移除的荣誉信息";
            $this->ajaxReturn($data);
        }
        if(!is_numeric($nid)){
            $data['code']=0;
            $data['msg']="参数错误，请稍后再试";
            $this->ajaxReturn($data);
        }
        $addr=M('honor');
        $result=$addr->where('id ='.$nid)->find();
        if($result){
            $deladdr=$addr->where('id ='.$nid)->delete();
            if($deladdr){
                $data['code']=1;
                $data['msg']="删除荣誉信息成功";
                $this->ajaxReturn($data);
            }else{
                $data['code']=0;
                $data['msg']="删除荣誉信息失败";
                $this->ajaxReturn($data);
            }
        }else{
            $data['code']=0;
            $data['msg']="要删除的荣誉信息不存在";
            $this->ajaxReturn($data);
        }
    }

}