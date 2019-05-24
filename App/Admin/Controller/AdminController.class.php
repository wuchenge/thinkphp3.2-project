<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends BaseController {
	/**
	*	管理员列表
	**/
    public function adminList(){
		$result=M('admin')->where('is_del =-1 and is_show = 1')->select();
		foreach($result as $k=>$v){
			$gls=M('role')->find($result[$k]['qid']);
			$result[$k]['rname'] =$gls['rname'] ;
		}
		$this->assign('result',$result);
		$this->display();
	}

	/**
	 *	管理员列表
	 **/
	public function adminAdd(){
		$gl=M('role')->select();
		$this->assign('gl',$gl);
		if(!empty($_GET['id'])){
			$gla=M('admin')->find($_GET['id']);
		}
		$this->assign('gla',$gla);
		$this->assign('gl',$gl);
		$this->display();
	}
	
	//增加管理员
	public function doadd(){
		$map['username']=I('post.username');
		$map['name']=I('post.name');
		$map['mobile']=I('post.mobile');
		$map['email']=I('post.email');
		$map['qid']=I('post.role');
		$gl['mobile']=$map['mobile'];
		$gl['is_del']=-1;
		$result=M('admin')->where($gl)->find();
		if($result){
			$this->error("该手机号已被注册");
		}
		if(empty($map['username'])){
			$this->error("请输入管理员账号");
		}
		if(empty($map['name'])){
			$this->error("请输入管理员姓名");
		}
		if(empty($map['qid'])){
			$this->error("请选择管理员权限");
		}
		if(empty($map['mobile'])){
			$this->error("请输入管理员手机号");
		}
		if(!preg_match("/^(13[0-9]|14[0-9]|15[0-9]|17[0-9]|18[0-9])\d{8}$/",$map['mobile'])){
			$this->error("请输入正确的手机号");
		}
		if(empty($map['email'])){
			$this->error("请输入管理员邮箱");
		}
		if(!preg_match("/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/",$map['email'])){
			$this->error("请输入正确的邮箱！");
		}
		$map['rand']=rand(1000,9999);
		$map['password']=md5(md5($map['mobile']).$map['rand'].md5($map['mobile']));
		$map['addtime']=time();
		$admin=M('admin')->add($map);
		if($admin){
			$this->success("新增管理员成功",U('Admin/adminList'));
		}else{
			$this->error("新增管理员失败");
		}
	}

	//编辑管理员
	public function doEdit(){
		$map['username']=I('post.username');
		$map['name']=I('post.name');
		$map['mobile']=I('post.mobile');
		$map['email']=I('post.email');
		$map['qid']=I('post.role');
		$gl['mobile']=$map['mobile'];
		if(empty($map['username'])){
			$this->error("请输入管理员昵称");
		}
		if(empty($map['name'])){
			$this->error("请输入管理员姓名");
		}
		if(empty($map['qid'])){
			$this->error("请选择管理员权限");
		}
		if(empty($map['mobile'])){
			$this->error("请输入管理员手机号");
		}
		if(!preg_match("/^(13[0-9]|14[0-9]|15[0-9]|17[0-9]|18[0-9])\d{8}$/",$map['mobile'])){
			$this->error("请输入正确的手机号");
		}
		if(empty($map['email'])){
			$this->error("请输入管理员邮箱");
		}
		if(!preg_match("/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/",$map['email'])){
			$this->error("请输入正确的邮箱！");
		}
		$map['rand']=rand(1000,9999);
		$map['password']=md5(md5($map['mobile']).$map['rand'].md5($map['mobile']));
		$map['addtime']=time();
		$admin=M('admin')->where('id ='.$_POST['id'])->save($map);
		if($admin){
			$this->success("修改管理员成功",U('Admin/adminList'));
		}else{
			$this->error("修改管理员失败");
		}
	}
	
	//管理员封号
	public function adminStop(){
		if($_SESSION['adminid'] == $_GET['id']){
			$data['status']=0;
			$data['msg']="您不能停用自己的帐号！";
			$this->ajaxReturn($data);
		}
		$fd = M("admin") -> find($_GET['id']);
		$fd['is_seal'] = 1;
		if(M("admin")->save($fd)){
			$data['status']=1;
			$data['msg']="禁用成功！";
			$this->ajaxReturn($data);
		}else{
			$data['status']=0;
			$data['msg']="禁用失败！";
			$this->ajaxReturn($data);
		}
	}

	//管理员解封
	public function adminStart(){
		$fd = M("admin") -> find($_GET['id']);
		$fd['is_seal'] = -1;
		if(M("admin")->save($fd)){
			$data['status']=1;
			$data['msg']="启用成功！";
			$this->ajaxReturn($data);
		}else{
			$data['status']=0;
			$data['msg']="启用失败！";
			$this->ajaxReturn($data);
		}
	}
	
	//管理员删除
	public function adminDel(){
		if($_SESSION['adminid'] == $_GET['id']){
			$data['status']=0;
			$data['msg']="您不能删除自己的帐号！";
			$this->ajaxReturn($data);
		}
		$fd = M("admin") -> find($_GET['id']);
		$fd['is_del'] = 1;
		if(M("admin")->save($fd)){
			$data['status']=1;
			$data['msg']="删除成功！";
			$this->ajaxReturn($data);
		}else{
			$data['status']=0;
			$data['msg']="删除失败！";
			$this->ajaxReturn($data);
		}
	}
	
	
	//管理员重置密码
	public function resetpwd(){
		if(IS_POST){
			$pwd=I('post.pwd');
			$password=I('post.password');
			$password1=I('post.password1');
			if(empty($pwd)){
				$this->error('旧密码不能为空');
			}
			if(empty($password)){
				$this->error('新密码不能为空');
			}
			if(empty($password1)){
				$this->error('确认密码不能为空');
			}
			if($password != $password1){
				$this->error('两次输入密码不一致');
			}
			$result=M('admin')->where('id ='.$_SESSION['adminid'])->find();
			$pwd=md5(md5($pwd).$result['rand'].md5($result['mobile']));
			if($pwd != $result['password']){
				$this->error('旧密码不正确');
			}
			$map['password']=md5(md5($password).$result['rand'].md5($result['mobile']));
			$fina=M('admin')->where('id ='.$_SESSION['adminid'])->save($map);
			if($fina){
				$this->success('重置密码成功,请重新登录',U('/Login/logout'));
			}else{
				$this->error('重置密码失败');
			}
		}else{
			$this->display();
		}
	}

	//角色列表
	public function adminRole(){
		$count=M('role')->count();
		$list=M('role')->order('is_one desc')->select();
		$this->assign('list',$list);
		$this->assign('count',$count);
		$this->display();
	}

	//角色新增
	public function adminRoleAdd(){
		if(!IS_POST){
			$this->display();
		}else{
			$_POST['addtime']=time();
			$gl=$_POST['quanxian'];
			$_POST['quanxian']="";
			$_POST['quanxian'] .= implode(',',$gl);
			if(empty($_POST['quanxian'])){
				$this->error('请设置角色的相应权限');
			}
			$_POST['quanxian'].=",admin-resetpwd,index-index";
			$admin=M('role')->add($_POST);
			if(!$admin==false){
				$this->success('新增角色成功',U('Admin/adminRole'));
			}else{
				$this->error('新增角色失败');
			}
		}
	}

	//角色修改
	public function adminRoleEdit(){
		if(!IS_POST){
			if(!empty($_GET['id'])){
				$gl=M('role')->find($_GET['id']);
			}
			$gl['quanxian']=explode(',',$gl['quanxian']);
			$this->assign('gl',$gl);
			$this->display("Admin/adminRoleAdd");
		}else{
			$_POST['quanxian'] = implode(',',$_POST['quanxian']);
			if(empty($_POST['quanxian'])){
				$this->error('请设置角色的相应权限');
			}
			$_POST['quanxian'].=",admin-resetpwd,index-index";
			$admin=M('role')->where('id ='.$_POST['id'])->save($_POST);
			if(!$admin==false){
				$this->success('修改角色成功',U('Admin/adminRole'));
			}else{
				$this->error('修改角色失败');
			}
		}
	}

	//角色删除
	public function roledel(){
		$nid=$_POST['id'];
		if(empty($nid)){
			$data['code']=0;
			$data['msg']="请选择要移除的角色信息";
			$this->ajaxReturn($data);
		}
		if(!is_numeric($nid)){
			$data['code']=0;
			$data['msg']="参数错误，请稍后再试";
			$this->ajaxReturn($data);
		}
		$addr=M('admin');
		$isshuju=$addr->where('qid ='.$nid)->find();
		if(!$isshuju==false){
			$data['code']=0;
			$data['msg']="该角色下有数据，请删除数据后再试";
			$this->ajaxReturn($data);
		}
		$result=M('role')->where('id ='.$nid)->find();
		if($result['is_one']==1){
			$data['code']=0;
			$data['msg']="超级管理员无法删除";
			$this->ajaxReturn($data);
		}
		if($result){
			$deladdr=M('role')->where('id ='.$nid)->delete();
			if($deladdr){
				$data['code']=1;
				$data['msg']="删除角色信息成功";
				$this->ajaxReturn($data);
			}else{
				$data['code']=0;
				$data['msg']="删除角色信息失败";
				$this->ajaxReturn($data);
			}
		}else{
			$data['code']=0;
			$data['msg']="要删除的角色信息不存在";
			$this->ajaxReturn($data);
		}
	}

}