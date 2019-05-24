<?php
// 本类由系统自动生成，仅供测试用途
namespace Admin\Controller;
use Think\Controller;
class PicController extends Controller {
	 public function uploadify()
    {
        if (!empty($_FILES['fileurl'])) 
        {
            $upload = new \Think\Upload();// 实例化上传类
			$upload->maxSize  = 3145728 ;// 设置附件上传大小
			$upload->exts  = array('jpg','jpeg','gif','png');// 设置附件上传类型
			$upload->savePath =  '/stores/';// 设置附件上传目录
			$info =  $upload->upload();
			if(!$info) {// 上传错误提示错误信息
			$this->error($upload->getError());
			}
			$str = '/Public/uploads'.$info['fileurl']['savepath'].$info['fileurl']['savename'];
			echo $str;    //返回文件名给JS作回调用
        }
    }

}