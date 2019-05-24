<?php
// 本类由系统自动生成，仅供测试用途
namespace Api\Controller;
use Think\Controller;
class WealController extends Controller {
	//商品列表页面
    public function index(){
		$title=I('post.title');
		$tcate=I('post.tcate');
		//搜索条件
		if(!empty($title)){
			$map['gname']=array('like','%'.$title.'%');
		}
		if(!empty($tcate)){
			$map['tcate']=$tcate;
			$res['dqcate']=M('productcate')->where('id ='.$tcate)->find();
		}
		$map['fcate']=61;
		$map['is_del']=-1;
		$map['is_up']=1;
		$map['type']=1;
		//参数获取
		$p = I('post.p');//页数
		if(empty($p)) $p = 1;
		$num=10;//每页数量
		$firstRow = ($p - 1) * $num;

		$orderstr="sort desc,addtime desc";
		//二级分类
		$res['cate']=M('productcate')
					->where('pid = 61')
					->field("title,id")
					->select();
		foreach ($res['cate'] as  $k=>$v) {
			//三级分类
			$res['cate'][$k]['sxjihe']=M('productcate')->where('pid ='.$v['id'])->select();
		}
		$this->assign('cate',$cate);
		$res['goods']=M('goods')
					->where($map)
					->field("gname,price,guige,imgurl2,id,tcate")
					->order($orderstr)
					->limit($firstRow, $num)->
					select();
		// if(empty($res['goods'])){
		// 	$return['stu'] = '0';
		// 	$return['code'] = '111';
		// 	$return['msg'] = '没有你要查询的数据';
		// 	$this->ajaxReturn($return);
		// }
		foreach ($res['goods'] as  $k=>$v) {
			 $res['goods'][$k]['imgs2']='https://'.$_SERVER['SERVER_NAME'].$v['imgurl'];
			 $res['goods'][$k]['listimg']=explode('|',$v['imgurl2']);
			 foreach ($res['goods'][$k]['listimg'] as $k2=> $v2) {
              $res['goods'][$k]['listimg'][$k2]="https://".$_SERVER['SERVER_NAME'].$v2;
           }
            // var_dump($res['goods'][$k]['listimg']);
            // $this->ajaxReturn('end');
		}
		$res['banner']=M('banner')->where('type=4')->select();
		foreach ($res['banner'] as $k=> $v){
              $res['banner'][$k]['img4']='http://'.$_SERVER['SERVER_NAME'].$v['img'];
        }
		$return['stu'] = '1';
		$return['res'] = $res;
		$this->ajaxReturn($return);
	}
    	//商品详情页面
    public function info(){
    	$id= trim(I("post.id/d"));
		$whe= '';
		$whe['id']=$id;
		$whe['is_del']=-1;
		$whe['is_up']=1;
		$res = M('goods')
			->field('gname,price,yprice,description,description2,description3,yunfei,yfmoney,jifen,nums,text,id,imgurl2,guige')
			->where($whe)
			->find();
		if(!$res){
            $return['stu'] = '0';
			$return['code'] = '111';
			$return['msg'] = '信息不存在';
			$this->ajaxReturn($return);
		}
		if(!empty($_SESSION['uid'])){
			$data['uid']=$_SESSION['uid'];
			$data['gid']=$id;
			$collres=M('coll')->where($data)->find();
			if(empty($collres)){
				$res['is_coll']=0;
			}else{
				$res['is_coll']=1;
			}
		}else{
			$res['is_coll']=0;
		}
		$res['rollimg']=explode('|',$res['imgurl2']);
		//array_unshift($res['rollimg'],$res['imgurl']);
		foreach ($res['rollimg'] as $k=>$v) {
			$res['rollimg'][$k]='https://'.$_SERVER['SERVER_NAME'].$v;
		}
		$lujing='https://'.$_SERVER['SERVER_NAME'].'/ueditor';
		//详情里的图片
		$res['text']=str_replace("/ueditor",$lujing,$res['text']);
		//规格列表
		$res['guige']=explode('|',$res['guige']);
        //评价取出
		$res['count'] = M("pingjia")->where("gid=".$id)->count();//总个数
		$res['hcount'] = M("pingjia")->where("status =1 and gid=".$id)->count();//晒图
		$res['zcount'] = M("pingjia")->where("status =2 and gid=".$id)->count();//追评
		//参数获取
		$p = I('post.p');//页数
		if(empty($p)) $p = 1;
		$num=10;//每页数量
		$firstRow = ($p - 1) * $num;
        $w['gid'] =$id;
		$w['status'] = 1;
        $res['comments'] = M('pingjia')->where($w)->order("addtime desc")->limit($firstRow, $num)->select();
        foreach($res['comments'] as $k => $v){
			$user = M("user")->where("id=".$v['uid'])->find();
			$res['comments'][$k]['username'] = $user['uname'];
			$res['comments'][$k]['headimg'] = $user['pic'];
		}
		$return['stu'] = '1';
		$return['res'] =$res;
		$this->ajaxReturn($return);

    }

}