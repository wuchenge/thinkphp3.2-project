<?php
namespace Admin\Controller;
use Think\Page;
use Think\Upload;
class BannerController extends BaseController{

    public function index(){
        $obj=M('Banner');
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
        $type=I('get.type','');
        if(!empty($type)){
            $where['type']=$type;
        }
        $count=$obj->where($where)->count();
        $Page = adminpage($count,10);
        $show = $Page->show();
        $data=$obj->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
        foreach ($data as $k=> $v) {
            switch($v['type']){
                case 1:
                    $data[$k]['tname']="办公用品";
                    break;          
                case 2:
                    $data[$k]['tname']="办公环境维护";
                    break;
                case 3:
                    $data[$k]['tname']="企业礼品";
                    break;
                case 4:
                    $data[$k]['tname']="员工福利";
                    break;
                case 5:
                    $data[$k]['tname']="精选商城";
                    break; 
                case 6:
                    $data[$k]['tname']="办公空间";
                    break;      
            }
        }
        $this->assign('page',$show);
        $this->assign('count',$count);
        $this->assign('data',$data);
        $this->display();
    }

    public function add(){
        if(IS_POST){
            $val=array(
                array('title','require','标题不能为空',1),
                array('url','/^https?:\/\/\S+$/','路径格式不正确',2),
                array('type','require','类型不能为空')
            );
            $obj=M('Banner');
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
            $upload->savePath =  '/banner/';// 设置附件上传目录
            $upload->autoCheck =  false;
            $info =  $upload->upload();
            if(!$info){
                // 上传错误提示错误信息
                $this->error($upload->getError());
            }
            $data['img'] = '/Public/uploads'.$info['image']['savepath'].$info['image']['savename'];
            $data['savetime']=time();
            if($obj->add($data)){
                $this->success('添加成功',U('banner/index'));
            }else{
                $this->error('添加失败');
            }
        }else{
            $this->display();
        }
    }

    public function sav(){
        $obj=M('Banner');
        if(IS_POST){
            $val=array(
                array('title','require','标题不能为空',1),
                array('url','/^https?:\/\/\S+$/','路径格式不正确',2),
                array('type','require','类型不能为空')
            );
            if($data=$obj->validate($val)->create()){
                if($_FILES['image']['name']){
                    $upload = new \Think\Upload();// 实例化上传类
                    $upload->maxSize  = 1024000 ;// 设置附件上传大小
                    $upload->exts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                    $upload->savePath =  '/banner/';// 设置附件上传目录
                    $upload->autoCheck =  false;
                    $info =  $upload->upload();
                    if(!$info){
                        // 上传错误提示错误信息
                        $this->error($upload->getError());
                    }
                    $data['img'] = '/Public/uploads'.$info['image']['savepath'].$info['image']['savename'];
                }
                $data['savetime']=time();
                if($obj->save($data)){
                    $this->success('修改成功',U('banner/index'));
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
        $obj=M('Banner');
        $data=$obj->where(array('id'=>array('eq',$id)))->find();
        if($data){
                if($obj->where(array('id'=>array('eq',$id)))->delete()){
                    $this->success('删除成功');
                }else{
                    $this->error('删除失败');
                }
        }else{
            $this->error('数据不存在');
        }
    }


}