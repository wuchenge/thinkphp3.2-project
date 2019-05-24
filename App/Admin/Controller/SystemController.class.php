<?php
namespace Admin\Controller;
use Think\Controller;
class SystemController extends BaseController {
    /**
     *	网站基本信息设置
     **/
    public function edit(){
        if (IS_POST) {
            $config = M("Config");
            $config->create();
            if(empty($_POST['title'])||empty($_POST['keywords'])||empty($_POST['description'])||empty($_POST['tel'])||empty($_POST['copy'])){
                $this->error('网站配置参数不能为空');
            }
            if(!empty($_FILES['gwimgurl']['name'])){
                $upload = new \Think\Upload();// 实例化上传类
                $upload->maxSize  = 1024000 ;// 设置附件上传大小
                $upload->exts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                $upload->savePath =  '/tupian/';// 设置附件上传目录
                $info =  $upload->upload();
                if(!$info) {// 上传错误提示错误信息
                    $this->error($upload->getError());

                }
                $config->gwimgurl = '/Public/uploads'.$info['gwimgurl']['savepath'].$info['gwimgurl']['savename'];
                //$config->weibo = '/Public/uploads'.$info['weibo']['savepath'].$info['weibo']['savename'];
            }
            if(!empty($_FILES['wximgurl']['name'])){
                $upload = new \Think\Upload();// 实例化上传类
                $upload->maxSize  = 1024000 ;// 设置附件上传大小
                $upload->exts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                $upload->savePath =  '/tupian/';// 设置附件上传目录
                $info =  $upload->upload();
                if(!$info) {// 上传错误提示错误信息
                    $this->error($upload->getError());

                }
                $config->wximgurl = '/Public/uploads'.$info['wximgurl']['savepath'].$info['wximgurl']['savename'];
                //$config->weibo = '/Public/uploads'.$info['weibo']['savepath'].$info['weibo']['savename'];
            }
            $result=$config->where('id = 1')->save();
            if($result!==false){
                $this->success('网站信息设置成功');
            }else{
                $this->error('网站信息设置失败');
            }
        } else {
            $sitegl = M('config')->find(1);
            $this->assign('sitegl', $sitegl);
            $this->display("System/edit");
        }
    }

}