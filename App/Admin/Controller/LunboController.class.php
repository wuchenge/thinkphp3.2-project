<?php
namespace Admin\Controller;
use Think\Page;
use Think\Upload;
class LunboController extends BaseController{

    public function index(){
        $obj=M('Ad');
        $start_time=strtotime(I('get.start_time',''));
        $end_time=strtotime(I('get.end_time',''));
        $description=I('get.description','');
        $where=array();
        if($start_time){
            $where['addtime']=array('gt',$start_time);
        }
        if($end_time){
            $where['addtime']=array('lt',$end_time);
        }
        if($start_time && $end_time){
            if($end_time<$start_time){
                $this->error('开始时间不能大于结束时间');
            }else{
                $where['savetime']=array('between',array($start_time,$end_time));
            }
        }
        if(trim($description)){
            $where['title']=array('like',"%$description%");
        }
        $count=$obj->where($where)->count();
        $show_num=10;
        $page=new Page($count,$show_num);
        $data=$obj->where($where)->limit($page->firstRow,$show_num)->order("type")->select();
        $show=$page->show();
        $count=count($data);
        $this->assign('show',$show);
        $this->assign('count',$count);
        $this->assign('data',$data);
        $this->display();
    }

    public function add(){
        if(IS_POST){
            $val=array(
                array('title','require','标题不能为空',1),
                array('url','/^https?:\/\/\S+$/','路径格式不正确',2),
                //array('type','/3|4/','类型不能为空')
            );
            $obj=M('Ad');
            $data=$obj->validate($val)->create();
            if(!$data){
                $this->error($obj->getError());
            }
            if(!$_FILES['image']['name']){
                $this->error('图片不能为空');
            }
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize  = 1024000 ;// 设置附件上传大小
            $upload->exts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->savePath =  '/lunbo/';// 设置附件上传目录
            $upload->autoCheck =  false;
            $info =  $upload->upload();
            if(!$info){
                // 上传错误提示错误信息
                $this->error($upload->getError());
            }
            $data['img'] = '/Public/uploads'.$info['image']['savepath'].$info['image']['savename'];
            // $image = new \Think\Image();
            // $image->open(".".$data['img']);
            // $image->thumb(1920, 600,\Think\Image::IMAGE_THUMB_FIXED)->save(".".$data['img']);
            $data['savetime']=time();
            if($obj->add($data)){
                $this->success('添加成功',U('lunbo/index'));
            }else{
                $this->error('添加失败');
            }
        }else{
            $this->display();
        }
    }

    public function sav(){
        $obj=M('Ad');
        if(IS_POST){
            $val=array(
                array('title','require','标题不能为空',1),
                array('url','/^https?:\/\/\S+$/','路径格式不正确',2),
            );
            if($data=$obj->validate($val)->create()){
                if($_FILES['image']['name']){
                    $upload = new \Think\Upload();// 实例化上传类
                    $upload->maxSize  = 1024000 ;// 设置附件上传大小
                    $upload->exts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                    $upload->savePath =  '/lunbo/';// 设置附件上传目录
                    $upload->autoCheck =  false;
                    $info =  $upload->upload();
                    if(!$info){
                        // 上传错误提示错误信息
                        $this->error($upload->getError());
                    }
                    $data['img'] = '/Public/uploads'.$info['image']['savepath'].$info['image']['savename'];
                    // $image = new \Think\Image();
                    // $image->open(".".$data['img']);
                    // $image->thumb(1920, 600,\Think\Image::IMAGE_THUMB_FIXED)->save(".".$data['img']);
                }
                $data['savetime']=time();
                if($obj->save($data)){
                    $this->success('修改成功',U('lunbo/index'));
                }else{
                    $this->error('修改失败');
                }
            }else{
                $this->error($obj->getError());
            }
        }else{
            $id=I('get.id');
            $data=$obj->where(array('id'=>array('eq',$id)))->find();
            $this->assign('data',$data);
            $this->display();
        }
    }

    public function del(){
        $id=I('post.id');
        $obj=M('Ad');
        $data=$obj->where(array('id'=>array('eq',$id)))->find();
        if($data){
                if($obj->where(array('id'=>array('eq',$id)))->delete()){
                    $this->success('删除成功');
                }else{
                    $this->error('数据库删除失败');
                }
        }else{
            $this->error('数据不存在');
        }
    }


}