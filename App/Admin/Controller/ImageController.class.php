<?php
namespace Admin\Controller;
use Think\Controller;
class ImageController extends Controller {
	/**
	*	图片列表
	**/
    public function imgList(){
        $this->display("Image/imglist");
    }
    /**
	*	图片添加
	**/
    public function imgAdd(){
        $this->display("Image/imgAdd");
    }
	/**
	*	图片展示
	**/
    public function imgShow(){
        $this->display("Image/imgShow");
    }
}