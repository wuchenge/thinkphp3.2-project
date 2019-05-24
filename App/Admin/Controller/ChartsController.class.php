<?php
namespace Admin\Controller;
use Think\Controller;
class ChartsController extends Controller {
	/**
	*	品牌管理
	**/
    public function Brand(){
        $this->display("Product/Brand");
    }
    /**
	*	产品管理
	**/
    public function ProductList(){
        $this->display("Product/ProductList");
    }
	/**
	*	分类管理
	**/
    public function CateList(){
        $this->display("Product/CateList");
    }
	/**
	*	分类添加
	**/
    public function CateAdd(){
        $this->display("Product/CateAdd");
    }
}