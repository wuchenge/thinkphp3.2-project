<?php
// 本类由系统自动生成，仅供测试用途
namespace Admin\Controller;
use Think\CommController\Controller;
class DanyeController extends BaseController {
	public function lists(){
		$danye = M("Danye")->where('is_show=1')->select();
		foreach($danye as $k => $v){
			$c = M("dy_cate")->where("id=".$v['cid'])->getField('title');
			$danye[$k]['cate_name'] = $c;
		}
		$this->assign("danye",$danye);
		$this->display();
	}
	
	public function add(){
		if(!IS_POST){
			$cate = M("DyCate")->select();
			$this->assign('cate',$cate);
			$this->display();
		}else{
			$cid = I('post.cid/d');
			if(!$cid)
			{
				$this->error('请选择所属栏目！');
			}
			$count = M("Danye")->where("cid=".$_POST['cid'])->count();
			if($count >=5){
				$this->error('一个栏目最多可以添加5个单页，该栏目已有5个');
			}
			$danye = M("Danye");
			//自动验证
			$rules = array(
	              
	         array('content','/\S+/','内容必须填写！',1,'regex'),// // 验证是否为空或者空格回车
	         array('title','/\S+/','标题必须填写！',1,'regex'),// // 验证是否为空或者空格回车

	        );  

	        if (!$danye->validate($rules)->create()){
	             // 如果创建失败 表示验证没有通过 输出错误提示信息
	             $this->error($danye->getError());
	        }

			$danye->time = time();
			$result = $danye->add();
			if($result){
				$this->success('添加成功',U("danye/lists"));
			}else{
				$this->error('添加失败，请稍候操作');
			}
		}
    }

    public function edit(){
		if(!IS_POST){
			$Danye = M("Danye")->where("id = ".$_GET['id'])->find();
			if($Danye){
				$cate = M("DyCate")->select();
				$this->assign('danye',$Danye);
				$this->assign('cate',$cate);
				$this->display();
			}else{
				$this->error('该数据不存在');
			}
		}else{
			if(empty($_POST['content'])){
				$this->error('请输入内容');
			}
			$danye = M("Danye");
			$danye->create();
			$danye->time = time();
			$result = $danye->save();
			if($result !== false){
				$this->success('编辑成功',U("danye/lists"));
			}else{
				$this->error('编辑失败，请稍候操作');
			}
		}
    }
	
	
	public function del(){
		$id = I("get.id");
		$danye = M("Danye")->where("id = ".$id)->find();
		if($danye){
			$result = M("Danye")->where("id = ".$id)->delete();
			if($result){
				$this->success('删除成功',U("danye/lists"));
			}else{
				$this->error('删除失败，请稍候操作');
			}
		}else{
			$this->error('该数据不存在');
		}
	}
	
}